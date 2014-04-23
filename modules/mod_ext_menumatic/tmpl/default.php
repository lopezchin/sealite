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

// No direct access.
defined('_JEXEC') or die;
// Note. It is important to remove spaces between elements.
$document 		= JFactory::getDocument();

if ($ext_style_menu == 0) { $document->addStyleSheet(JURI::base() . 'modules/mod_ext_menumatic/css/horizontal-menumatic.css'); $ext_style = 'horizontal'; }
	else 				 { $document->addStyleSheet(JURI::base() . 'modules/mod_ext_menumatic/css/vertical-menumatic.css'); 	 $ext_style = 'vertical'; }

if ($ext_menu == 1) {	
	if ($ext_mootools == 1) { $document->addScript(JURI::base() . 'modules/mod_ext_menumatic/js/mootools-yui-compressed.js'); }
	if ($ext_mootools == 2) { $document->addScript('http://ajax.googleapis.com/ajax/libs/mootools/1.3.2/mootools-yui-compressed.js'); }
$document->addScript(JURI::base() . 'modules/mod_ext_menumatic/js/MenuMatic_0.68.3.js'); 
}
?>


<ul id="extnav" class="menu <?php echo $class_sfx;?>">
<?php
foreach ($list as $i => &$item) :
	$class = '';
	if ($item->id == $active_id) {
		$class .= 'current ';
	}

	if (	$item->type == 'alias' &&
			in_array($item->params->get('aliasoptions'),$path)
		||	in_array($item->id, $path)) {
	  $class .= 'active ';
	}
	if ($item->deeper) {
		$class .= 'deeper ';
	}
	
	if ($item->parent) {
		$class .= 'parent ';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li id="item-'.$item->id.'"'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_ext_menumatic', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_ext_menumatic', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul>';
	}
	// The next item is shallower.
	else if ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>
<script type="text/javascript">
        window.addEvent('domready', function() {            
            var myMenu = new MenuMatic({ 
				orientation:'<?php echo $ext_style; ?>',
				opacity:'<?php echo $ext_opacity; ?>',
				hideDelay:'<?php echo $ext_hidedelay; ?>',				
				duration:'<?php echo $ext_duration; ?>',
				effect:'<?php echo $ext_effect; ?>',
				physics:<?php echo $ext_physics;?>
			});         
        });     
</script>