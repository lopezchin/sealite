<?php
/**
 * Hello World! Module Entry Point
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
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (isset($_POST['action']) ) {
	// Mail command

	var_dump('yes' . " - " . $_POST['current_uid']);


	$current_user_id = isset($_POST['current_uid']) ? $_POST['current_uid'] : null;
	$current_image_name = isset($_POST['current_image_name']) ? $_POST['current_image_name'] : null;

	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	// Order it by the ordering field.
	$query->select($db->quoteName(array('id', 'company', 'name', 'saleterritory', 'address', 'phone', 'fax', 'cellphone', 'email')));
	$query->from($db->quoteName('#__users'));
	$query->where($db->quoteName('id') . ' LIKE '. $current_user_id);
	// Reset the query using our newly populated query object.
	$db->setQuery($query);
	// Load the results as a list of stdClass objects (see later for more options on retrieving data).
	$results = $db->loadObjectList();

	foreach ($results as $result);


	//to send email dynamically after uploading image
	
	$to      = 'philwebservices.designer21@gmail.com';
	$subject = 'Uploaded images';
	$message = 	$result->name.' uploaded '.$current_image_name.' image from portal.'."\n\n". 'This message can be change from /module/mod_listingpage/mod_listingpage.php';
	$headers = 'From: '.$result->email. "\r\n" .
	    'Reply-To: $result->email'. "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

	// fetch data from the database, intended for its image

	// if found then continue,

		// fetch the information required for the email body and header

		// send email via joomla

	// else do nothing

	die(); return "";
}

// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
// $hello = modLatestNewsHelper::getTitle( $params );

$article_news = modListingPage::getlistategory( $params );
$cat_news = modListingPage::fetchCategoryId( $params );
require( JModuleHelper::getLayoutPath( 'mod_listingpage' ) );

?>