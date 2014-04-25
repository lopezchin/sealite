<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributor_form/css/mod_distributor_form.css');

$user = JFactory::getUser();

$disID=$user->id;


$db = JFactory::getDbo();
$query = $db->getQuery(true);
// Order it by the ordering field.
$query->select($db->quoteName(array('id', 'company', 'name','username', 'saleterritory', 'address', 'phone', 'fax', 'cellphone', 'email', 'password')));
$query->from($db->quoteName('#__users'));
$query->where($db->quoteName('id') . ' LIKE '. $disID);
// Reset the query using our newly populated query object.
$db->setQuery($query);
// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();

foreach ($results as $result);

 // Get the global JAuthentication object
  // jimport( 'joomla.user.authentication');
  // $auth = JAuthentication::getInstance();

  // $credentials = array( 'username' => $result->username, 'password' => $this->password );
  // $options = array();
  // $response = $auth->authenticate($credentials, $options);

  // // success
  // if ($response->status === JAUTHENTICATE_STATUS_SUCCESS) {
  //   $response->status = true;
  // } else {
  // // failed
  //   $response->status = false;
  // }
  // echo json_encode($response);

//var_dump($response);

?>



<div class="distributor_form_container">
	<div class="disform--title">
		<span class="dis-form">Edit Details</span>
		<span class="dis-form2">Change Password</span>

	</div>
	<div class="distibutor-form">
		<form name='dis-form' id='dis-form' class="dis-form" method='POST'>
			<div class="field">
				<div><label for='company'>Company Name</label></div>
				<div><input type='text' name='company' id='company' value='<?php echo $result->company; ?>'/></div>
			</div>
			<div class="field">
				<div><label for='name'>Distributor's Name</label></div>
				<div><input type='text' name='name' id='name' value='<?php echo $result->name; ?>'/></div>
			</div>
			<div class="field">
				<div><label for="saleterritory">Sale Territory</label></div>
				<div><input type='text' name='saleterritory' id='saleterritory' value='<?php echo $result->saleterritory; ?>'/></div>
			</div>
			<div class="field">
				<div><label for='address'>Address</label></div>
				<div><input type='text' name='address' id='address' value='<?php echo $result->address; ?>'/></div>
			</div>
			<div class="field form-column">
				<div><label for='phone'>Phone</label></div>
				<div><input type='text' name='phone' id='phone' value='<?php echo $result->phone; ?>'/></div>
			</div>
			<div class="field form-column">
				<div><label for='fax'>Fax</label></div>
				<div><input type='text' name='fax' id='fax' value='<?php echo $result->fax; ?>'/></div>
			</div>
			<div class="field form-column">
				<div><label for='cellphone'>Mobile</label></div>
				<div><input type='text' name='cellphone' id='cellphone' value='<?php echo $result->cellphone; ?>'/></div>
			</div>
			<div class="field form-column">
				<div><label for='email'>Email</label></div>
				<div><input type='text' name='email' id='email' value='<?php echo $result->email; ?>'/></div>
			</div>
			<div class="clear"></div>
			<div class="field">
				<p class="details">
					<span>A note on Images</span>. Distributor Profiles now includes automatic image re-sizing. 
					If the image you submit is larger than the recommended size, it will be automatically reduced to fit. 
					If it is already of the correct size (or smaller) it will be reproduced as-is. We hope this is useful to you.

				</p>
			</div>
			<div class="field">
				<div></div>
				<div><input type='hidden' name='dist_id' id='dist_id' value='<?php echo $result->id ; ?>'/></div>
			</div>
			<div class="field">
				<div class="dist-divider"></div>
			</div>
			
			<div>
				<input type='submit' id='dis-form-update' class='dis-form-update' name='distributor_update' value='Update Detail' />
			</div>
			<div class="clear"></div>
		</form><br>

		<form name='dis-form' id='dis-form' class="dis-form2" method='POST'>		
			<div class="field">
				<div><label for='password'>New Password</label></div>
				<div><input type='password' name='password' id='password' placeholder="Password" /></div>
			</div>
			<div class="field">
				<div><label for='confirm-password'>Confirm Password</label></div>
				<div><input type='password' name='confirmPassword' id='confirmPassword' placeholder="Confirm Password" /></div>
			</div>
			<div class="field">
				<div></div>
				<div><input type='hidden' name='dist_id' id='dist_id' value='<?php echo $result->id; ?>'/></div>
			</div>
			<div class="field">
				<div class="dist-divider"></div>
			</div>
			
			<div>
				<input type='submit' id='dis-form-update' class='dis-form-update' name='update_password' value='Update Password' />
			</div>
			<div class="clear"></div>
		</form>
		
	</div>


	
</div>
