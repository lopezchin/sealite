<?php
defined('_JEXEC') or die('Access Deny');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributorlist/css/mod_distributorlist.css');
$doc->addScript(JURI::root().'/modules/mod_distributorlist/js/mod_distributorlist.js');
?>

<form name='contactform' id='contactform' method='POST' action="">
	<div class='division'>
		<div class='label' ><label for='name'>Fullname</label></div>
		<div class='input'><input type='text' name='name' id='name' /></div>
	</div>
	<div class="clear"></div>
	<div class='division'>
		<div class='label' ><label for='email'>Email</label></div>
		<div class='input'><input type='email' name='email' id='email' /></div>
	</div>
	<div class="clear"></div>
	<div class='division'>
		<div class='label' ><label for='message'>Message</label></div>
		<div class='input'><textarea id='message' name='message'></textarea></div>
	</div>
	<div class="clear"></div>

	<input type='submit' value='Submit' class="submit" name='contact_btn' id='contact_btn'/>
</form>

