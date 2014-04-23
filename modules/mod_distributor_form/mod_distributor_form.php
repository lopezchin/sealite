<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
$jinput=JFactory::getApplication()->input;


if(isset($_POST['distributor_update'])){	

		$uptID = $jinput->get('dist_id','','RAW'); // dont use id in the input name hidden
		$name=$jinput->get('name','','STRING');
		$company=$jinput->get('company','','RAW');
		$saleterritory=$jinput->get('saleterritory','','RAW');
		$address=$jinput->get('address','','RAW');
		$phone=$jinput->get('phone','','RAW');
		$fax=$jinput->get('fax','','RAW');
		$cellphone=$jinput->get('cellphone','','RAW');
		$email=$jinput->get('email','','RAW');
		$password=$jinput->get('password','','RAW');


		// echo $uptID.'<br>'.$name.'<br>'.$company.'<br>'.$saleterritory.'<br>'.$address.'<br>'.$phone.'<br>'.$fax.'<br>'.$cellphone.'<br>'.$email;

		if($name==null || $company==null || $saleterritory==null || $address==null || $phone==null || $fax==null || $cellphone==null || $email==null){
			echo  "<div class='dist-error'>Some input cannot be blank.</div>";			
			require( JModuleHelper::getLayoutPath( 'mod_distributor_form' ) );
		}else{
			$object = new stdClass();
			 
			// Must be a valid primary key value.
			$object->id = $uptID;
			$object->name = $name;
			$object->company = $company;
			$object->saleterritory = $saleterritory;
			$object->address = $address;
			$object->phone = $phone;
			$object->fax = $fax;
			$object->cellphone = $cellphone;
			$object->email = $email;
			 
			// Update their details in the users table using id as the primary key.
			$result = JFactory::getDbo()->updateObject('#__users', $object, 'id');

			// Create an object for the record we are going to update.
			echo "<div class='dist-success'>Distributor successfully updated</div>";
		}

}else if(isset($_POST['update_password'])){
	$user = JFactory::getUser();

	$currentEmail=$jinput->get('eMail','','RAW');
	$password=$jinput->get('password', '', 'RAW');
	$confirmPassword=$jinput->get('confirmPassword', '', 'RAW');

	// echo sha1(md5($dataPass));
	// echo '<br>';

	// echo base64_decode($currentPassword);

	if($password == $confirmPassword ){
		
		$uptID = $jinput->get('dist_id','','RAW');
		$password=$jinput->get('password','','RAW');

		if($password == null || $confirmPassword == null){
			echo  "<div class='dist-error'>Password input cannot be blank.</div>";
			require JModuleHelper::getLayoutPath('mod_distributor_form', $params->get('layout', 'update_password'));
		}else{
			

			$object = new stdClass();

			$object->id = $uptID;
			$object->password = md5($password);
			 
			// Update their details in the users table using id as the primary key.
			$result = JFactory::getDbo()->updateObject('#__users', $object, 'id');

			// Create an object for the record we are going to update.
			echo "<div class='dist-success'>Password successfully updated</div>";
		}
	}else{
	 	echo "<div class='dist-error'>Your password does not match. Please Try Again</div>";		
	 	require JModuleHelper::getLayoutPath('mod_distributor_form', $params->get('layout', 'update_password'));
	}

}else{	
	$hello = modDistributorFormHelper::getTitle( $params );
	require( JModuleHelper::getLayoutPath( 'mod_distributor_form' ) );
}


?>