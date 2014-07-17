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
class modAdvertiseSlider
{
    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    public static function getImages( $params )
    {
        JModelLegacy::addIncludePath(JPATH_ROOT.'/components/com_banners/models', 'BannersModel');
        $document   = JFactory::getDocument();
        $app        = JFactory::getApplication();
        $keywords   = explode(',', $document->getMetaData('keywords'));

        $model = JModelLegacy::getInstance('Banners', 'BannersModel', array('ignore_request'=>true));
        $model->setState('filter.category_id', $params->get('catid', array()));

        $banners = $model->getItems();
        $model->impress();

        return $banners;
    }
}
?>