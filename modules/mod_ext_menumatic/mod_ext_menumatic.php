<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2013 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 02/08/2012 - 12:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list			= modEXTMATICMenuHelper::getList($params);
$app			= JFactory::getApplication();
$menu			= $app->getMenu();
$active			= $menu->getActive();
$active_id 		= isset($active) ? $active->id : $menu->getDefault()->id;
$path			= isset($active) ? $active->tree : array();
$showAll		= $params->get('showAllChildren');
$class_sfx		= htmlspecialchars($params->get('class_sfx'));
$ext_style_menu	= $params->get('stylemenu');
$ext_menu		= $params->get('ext_menu');
$ext_mootools	= $params->get('mootools');
$ext_opacity	= $params->get('opacity');
$ext_hidedelay	= $params->get('hidedelay');
$ext_physics	= $params->get('physics');
$ext_duration	= $params->get('duration');
$ext_effect		= $params->get('effect');

if(count($list)) {
	require JModuleHelper::getLayoutPath('mod_ext_menumatic', $params->get('layout', 'default'));
	// echo JText::_(COP_JOOMLA);
}
?>

