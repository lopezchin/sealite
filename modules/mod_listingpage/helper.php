<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */


class modListingPage
{
    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    

    public static function fetchCategoryId( $params ){
        $cat_id = $params->get('catid',array());

        //use this foreach condition for getting the value of xml field check at .xml file of this module
        if($cat_id==null){
            $cat_id=null;
        }else{
            foreach($cat_id as $ids) {
                $id = $ids;
            }
        }
        
        // var_dump($id);
        
        // Get a db connection. 
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id', 'title', 'alias', 'published', 'path')));
        $query->from($db->quoteName('#__categories'));
        $query->where($db->quoteName('id') . ' = '. $id);
        $db->setQuery($query);

        $cat_news = $db->loadObjectList();

        return $cat_news;

    }

    public static function getlistategory( $params ){

        $cat_id = $params->get('catid',array());


        if($cat_id==null){
            $cat_id=null;
        }else{
            foreach($cat_id as $ids) {
                $id = $ids;
            }
        }

        $db = JFactory::getDbo();
        
        $query = $db->getQuery(true);
        
        $query->select($db->quoteName(array('id', 'title', 'alias', 'catid', 'images', 'created', 'state', 'introtext')));
        $query->from($db->quoteName('#__content'));
        $query->where($db->quoteName('catid') . ' = '. $id);
        $query->order('ordering ASC');
        
        $db->setQuery($query);
        
        $article_results = $db->loadObjectList();

        return $article_results;
    }

}
?>