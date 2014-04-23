<?php

class modDistributorFormHelper
{
    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    public static function getTitle( $params )
    {
        $app = JFactory::getApplication();
        if($app->getMenu()->getActive()==null){
            return false;
        }else{
            $title = $app->getMenu()->getActive()->title;
            return $title;
        }
    }
}
?>