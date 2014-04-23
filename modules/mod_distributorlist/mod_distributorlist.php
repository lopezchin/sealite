<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( dirname(__FILE__).DS.'helper.php' );

$jinput=JFactory::getApplication()->input;

if(isset($_POST['save'])){	
	$distList=$jinput->get('dist-list','','STRING');

	if($distList=='new distributor'){
		require JModuleHelper::getLayoutPath('mod_distributorlist', $params->get('layout', 'form'));	
	}else{
		$listID = $jinput->get('dist-list');
		// echo $listID;
		
		require JModuleHelper::getLayoutPath('mod_distributorlist', $params->get('layout', 'form-with-value'));
	}	
}else if(isset($_POST['contact_btn'])){	

	$name=$jinput->get('name','','STRING');
	$email=$jinput->get('email','','RAW');
	$message=$jinput->get('message','','RAW');

	if($name==null || $email==null || $message==null){
		echo "<div class='dist-error'>Some input cannot be blank.</div>";
		require JModuleHelper::getLayoutPath('mod_distributorlist', $params->get('layout', 'form'));	
	}else{
		modDistributorListHelper::saveData($name,$email,$message);
		echo "<div class='dist-success'>Distributor successfully Added</div>";
	}

}else if(isset($_POST['contact_update'])){	
	$uptID = $jinput->get('distID','','RAW');
	$name=$jinput->get('name','','STRING');
	$email=$jinput->get('email','','RAW');
	$message=$jinput->get('message','','RAW');

	//echo $uptID.'<br>'.$name.'<br>'.$email.'<br>'.$message;

	if($name==null || $email==null || $message==null){
		echo  "<div class='dist-error'>Some input cannot be blank.</div>";			
		require( JModuleHelper::getLayoutPath( 'mod_distributorlist' ) );
	}else{
		$object = new stdClass();
		 
		// Must be a valid primary key value.
		$object->id = $uptID;
		$object->name = $name;
		$object->email = $email;
		$object->message = $message;
		 
		// Update their details in the users table using id as the primary key.
		$result = JFactory::getDbo()->updateObject('#__contactform_listing', $object, 'id');

		// Create an object for the record we are going to update.
		echo "<div class='dist-success'>Distributor successfully updated</div>";
	}

}else{
	$distlisting = modDistributorListHelper::getDistributorList();
	require( JModuleHelper::getLayoutPath( 'mod_distributorlist' ) );


}

//$list = modDistributorListHelper::getList( $params );
?>