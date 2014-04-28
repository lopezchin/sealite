<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
$jinput=JFactory::getApplication()->input;


if(isset($_POST['distributor_update'])){	

	$sealite_code=$jinput->get('key','','RAW');


	if($sealite_code=='' || $sealite_code==null){

			// $havecode=$jinput->get('havecodekey','','RAW');

			// echo "already have code ".$havecode;

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

	}else{
		
			//echo $sealite_code.' not empty';

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
			$sealite_code=$jinput->get('key','','RAW');


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
				$object->sealite_code = $sealite_code;
				 
				// Update their details in the users table using id as the primary key.
				$result = JFactory::getDbo()->updateObject('#__users', $object, 'id');

				//send email to the current user logged after changing password
				$to      = $email;
				$subject = 'Update Account With Verification Code';
				$message = 	'Your profile has been updated.'."\n".'Also save this sealite member verification code ( '.$sealite_code.' ) for changing/updating your password.'
							."\n\n".'Kind regards,'."\n".'Sealite Team';
				$headers = 'From: Administrator'."\r\n".
				    'Reply-To: sealite@administrator.com'. "\r\n" . // change this if neccessarily 
				    'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);

				// Create an object for the record we are going to update.
				echo "<div class='dist-success'>Distributor successfully updated. We also send you a sealite verification code for your security purpose.</div>";
			}
	}

}else if(isset($_POST['update_password'])){
	$user = JFactory::getUser();
	
	$uptID = $jinput->get('dist_id','','RAW');

	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	// Order it by the ordering field.
	$query->select($db->quoteName(array('id', 'company', 'name','username', 'saleterritory', 'address', 'phone', 'fax', 'cellphone', 'email', 'password', 'sealite_code')));
	$query->from($db->quoteName('#__users'));
	$query->where($db->quoteName('id') . ' LIKE '. $uptID);
	// Reset the query using our newly populated query object.
	$db->setQuery($query);
	// Load the results as a list of stdClass objects (see later for more options on retrieving data).
	$results = $db->loadObjectList();

	foreach ($results as $result);

	$data_vcode=$result->sealite_code;

	$verification=$jinput->get('verification', '', 'RAW');

	if($verification==$data_vcode){

		//if verification code success

		$password=$jinput->get('password', '', 'RAW');
		$confirmPassword=$jinput->get('confirmPassword', '', 'RAW');

		// echo sha1(md5($dataPass));
		// echo '<br>';

		// echo base64_decode($currentPassword);

		if($password == $confirmPassword ){
			
			$uptID = $jinput->get('dist_id','','RAW');
			$password=$jinput->get('password','','RAW');
			$currentEmail=$jinput->get('currentEmail','','RAW');

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


				//send email to the current user logged after changing password
				$to      = $currentEmail;
				$subject = 'Sealite Changed Password';
				$message = 	'Your password changed to ('.$password.').'."\n".'If not you please check your account to avoid account hack.'."\n\n".'Kind regards,'."\n".'Sealite Team';
				$headers = 'From: Administrator'."\r\n".
				    'Reply-To: sealite@administrator.com'. "\r\n" . // change this if neccessarily 
				    'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);

				echo "<div class='dist-success'>Password successfully updated. Please check your email for more info.</div>";
			}
		}else{
		 	echo "<div class='dist-error'>Your password does not match. Please Try Again</div>";		
		 	require JModuleHelper::getLayoutPath('mod_distributor_form', $params->get('layout', 'update_password'));
		}

	}else{
		echo "<div class='dist-error'>Invalid Verification Code</div>";		
		require JModuleHelper::getLayoutPath('mod_distributor_form', $params->get('layout', 'update_password'));
	}
}else{	
	$hello = modDistributorFormHelper::getTitle( $params );
	require( JModuleHelper::getLayoutPath( 'mod_distributor_form' ) );
}


?>