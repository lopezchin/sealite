<?php
defined('_JEXEC') or die('Access Deny');

class modDistributorListHelper
{
	public static function saveData($name,$email,$message){

		$db=JFactory::getDBO();
		$query= "INSERT INTO #__contactform_listing (name,email,message) VALUES('$name','$email','$message')" ;

		$db->setQuery($query);

		$result=$db->query();
		return $result;
	}
	
	public static function getDistributorList(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		// Order it by the ordering field.
		$query->select($db->quoteName(array('id', 'name', 'email', 'message')));
		$query->from($db->quoteName('#__contactform_listing'));
		$db->setQuery($query);
		$results = $db->loadObjectList();

		return $results;
	}

}