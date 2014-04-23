<?php
defined('_JEXEC') or die('Access Deny');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributorlist/css/mod_distributorlist.css');
$doc->addScript(JURI::root().'/modules/mod_distributorlist/js/mod_distributorlist.js');

// Get a db connection.	
$db = JFactory::getDbo();
$query = $db->getQuery(true);
// Order it by the ordering field.
$query->select($db->quoteName(array('id', 'name', 'email', 'message')));
$query->from($db->quoteName('#__contactform_listing'));
$query->where($db->quoteName('id') . ' LIKE '. $listID);
// Reset the query using our newly populated query object.
$db->setQuery($query);
// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();

foreach ($results as $result);

?>

<form name='contactform' id='contactform' method='POST'>
	<div class='division'>
		<div class='label' ><label for='name'>Fullname</label></div>
		<div class='input'><input type='text' name='name' id='name' value='<?php echo $result->name; ?>'/></div>
	</div>
	<div class="clear"></div>
	<div class='division'>
		<div class='label' ><label for='email'>Email</label></div>
		<div class='input'><input type='email' name='email' id='email' value='<?php echo $result->email; ?>'/></div>
	</div>
	<div class="clear"></div>
	<div class='division'>
		<div class='label' ><label for='message'>Message</label></div>
		<div class='input'><textarea id='message' name='message'><?php echo $result->message; ?></textarea></div>
	</div>
	<div class="clear"></div>
	<input type='hidden' name='distID' id='distID' value='<?php echo $result->id; ?>'/>
	<input type='submit' value='Update' class="submit" name='contact_update' id='contact_update'/>
</form>