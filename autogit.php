#!/usr/bin/env php
<?php
/* ========================================================================
 * Onejs: onejs.php v1.0.0
 * http://github.com/neratillo/onejs
 * ========================================================================
 * Copyright 2013 Ner Atillo
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * * ======================================================================== */

$auto_git = new Autogit;
exit($auto_git);

class Autogit{

    var $_prime_dir_name = 'public_html';

    /**
     * the argument that is passed after the php onejs.php [arg1] [arg2]
     * @var array
     */
    var $_args = array();

    /**
     * The [arg1] which appears next to onejs.php
     * @var bool
     */
    var $_git_name = 'test';

    /**
     * The message that is return via exceptions
     * @var string
     */
    var $_exceptions = "";

    function __construct() {
        $this->doRun();
    }

    /**
     * run on initiation
     *
     * @return Void
     */
    protected function doRun() {

        // get the arguments after the "php onejs.php [arg] [arg]
        $args = $_SERVER['argv'];
        array_shift($args);
        $this->_setArguments($args);

        try {
            $this->_start();
        } catch (Exception $e){
            $this->_exceptions = $e->getMessage();
        }
    }

    /**
     * Set arguments default value
     * @link php autogit.php [git-name] [target-server-dir]
     * @param $args
     */
    private function _setArguments($args) {
        $this->_git_name = isset($args[0])    ? $args[0] : $this->_git_name;
        $this->_prime_dir_name = isset($args[1])    ? $args[1] : $this->_prime_dir_name;
    }

    private function _validatePostUpdate($path) {
        if (!is_file($path)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * This will start the onejs.php merger and compiler
     * @throws Exception
     */
    protected function _start(){

        // get options
        // ~/' . $this->_prime_dir_name . '
        exec('git init',$output);
        exec('git add .',$output);
        exec('git commit -m "Initial commit for existing website files";',$output);
        exec('git status',$output);
        exec('git log',$output);
        exec('chmod 770 -R .git/',$output);

        // ~
        chdir('../');
        exec('mkdir ' . $this->_git_name . '.git',$output);
        chdir($this->_git_name . '.git');
        exec('git --bare init',$output);

        // ~/test.git
        chdir('../' . $this->_prime_dir_name . '');

        exec('git remote add ' . $this->_git_name . ' ../' . $this->_git_name . '.git',$output);
        exec('git remote show ' . $this->_git_name . '',$output);
        exec('git push ' . $this->_git_name . ' master',$output);
        $this->_display_output($output);

        // ~/test.git/hooks
        $post_update_path = '../' . $this->_git_name . '.git/hooks/post-update';
        if (!$this->_validatePostUpdate( $post_update_path )){
            exec('touch ' . $post_update_path);
        }
        exec('chmod 777 ' . $post_update_path);

        $file_override_update = file_put_contents( $post_update_path ,$this->_post_update_contents());

        if (!$file_override_update){
            // @todo revert all the run ocmmand
            throw new Exception('Something went wrong please try again.');
        }

    }

    protected function _post_update_contents() {
        ob_start();
        ?>
#!/bin/sh
#
# An example hook script to prepare a packed repository for use over
# dumb transports.
#
# To enable this hook, rename this file to "post-update".

echo
echo "*** pulling changes into Prime [Hub's post-update hook]"
echo

cd ../<?php echo $this->_prime_dir_name; ?> || exit
unset GIT_DIR
git pull <?php echo $this->_git_name; ?> master
# git reset --hard <?php echo $this->_git_name; ?>/master

exec git update-server-info
        <?php
        return ob_get_clean();
    }

    function _display_output($output) {
        print_r($output);
    }

    /**
     * Return exceptions
     * @return string
     */
    function __toString(){
        return $this->_exceptions;
    }
}

