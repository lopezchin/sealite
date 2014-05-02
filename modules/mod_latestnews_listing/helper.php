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
class modLatestNewsListingHelper
{
    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    public static function fetchCategoryId( $params ){
        $cat_id = $params->get('category_id');

        // Get a db connection. 
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id', 'title', 'alias', 'published', 'path')));
        $query->from($db->quoteName('#__categories'));
        $query->where($db->quoteName('id') . ' LIKE '. $cat_id);
        $db->setQuery($query);

        $cat_result = $db->loadObjectList();

        return $cat_result;

    }

    public static function getCategory( $params ){

        $cat_id = $params->get('category_id');
        $db = JFactory::getDbo();
        
        $query = $db->getQuery(true);
        
        $query->select($db->quoteName(array('id', 'title', 'alias', 'catid', 'images', 'created', 'state')));
        $query->from($db->quoteName('#__content'));
        $query->where($db->quoteName('catid') . ' LIKE '. $cat_id);
        
        $db->setQuery($query);
        
        $article_results = $db->loadObjectList();

        return $article_results;
    }
}
?>