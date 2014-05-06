<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributor_form/css/mod_distributor_form.css');

$user = JFactory::getUser();

$disID=$user->id;


$db = JFactory::getDbo();
$query = $db->getQuery(true);
// Order it by the ordering field.
$query->select($db->quoteName(array('id', 'company', 'name','username', 'saleterritory', 'address', 'phone', 'fax', 'cellphone', 'email', 'password', 'sealite_code', 'image')));
$query->from($db->quoteName('#__users'));
$query->where($db->quoteName('id') . ' LIKE '. $disID);
// Reset the query using our newly populated query object.
$db->setQuery($query);
// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();

foreach ($results as $result);

$currentEmail = $result->email;

//auto generate sealite code

$sealite_code = $result->sealite_code;

$sealiteCode = substr( md5(rand()), 0, 10);

$image = $result->image;

if($image!='' && $image!=null){
	$image = 'images/user-avatar/'.$result->image;
}else{
	$image = 'modules/mod_distributorcredential/images/profile-icon.png';
} 

?>

<div class="distributor_form_container">
	<?php if($sealite_code!='' && $sealite_code!=null){ ?>
		<div class="disform--title">
			<span class="dis-form">Edit Details</span>
			<span class="dis-form2">Change Password</span>
			<span class="dis-form3">Update Avatar</span>
		</div>
	<?php }else{ ?>
		<div class="disform--title">
			<span class="dis-form update">Update First to have the verification code.</span>
			<span class="dis-form2 update">Update First to have the verification code.</span>
			<span class="dis-form3 update">Update First to have the verification code.</span>

		</div>
	<?php } ?>

<!-- Update user detail -->

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

			<?php if($sealite_code==''){ ?>
				<div class="field">
					<div><label for='Verification key'>Sealite Code</label></div>
					<div><input type='text' name='key_code' id='key_code' value='<?php echo $sealiteCode; ?>' disabled/></div>
					<div><input type='hidden' name='key' id='key' value='<?php echo $sealiteCode; ?>'/></div>
				</div>
			<?php }else{ } ?>
				
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

<!-- End Update user detail -->

<!-- changing password here -->

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
				<div><label for='verificatoin-code'>Verification Code</label></div>
				<div><input type='text' name='verification' id='verification' placeholder="Verification Code" /></div>
			</div>
			<div class="field">
				<div></div>
				<div><input type='hidden' name='dist_id' id='dist_id' value='<?php echo $result->id; ?>'/></div>
			</div>
			<div class="field">
				<div class="dist-divider"></div>
			</div>
			

			<?php if($sealite_code!='' && $sealite_code!=null){ ?>
				<div>
					<input type='hidden' name='currentEmail' id='currentEmail' value="<?php echo $currentEmail; ?>" />
					<input type='submit' id='dis-form-update' class='dis-form-update resend_verification' name='resend_verification' value='Resend Verification'/>
					<input type='submit' id='dis-form-update' class='dis-form-update' name='update_password' value='Update Password'/>
				</div>
			<?php }else{ ?>
				<div class="field">
				<div><label>Need to update first.</label></div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</form>

<!-- End changing password here -->
		

<!-- uploading image -->

		<form name='dis-form' id='dis-form' class="dis-form3" method='POST' enctype="multipart/form-data">		

			<div class="preview_image">
				<img src="<?php echo $image; ?>" width="160" height="160">
			</div>

			<label for="file">Filename:</label>
			<input type="file" name="file" id="file">
			<input type='hidden' name='dist_id' id='dist_id' value='<?php echo $result->id; ?>'/><br>
			<div class="field">
				<div class="dist-divider"></div>
			</div>
			<input type="submit" class='dis-form-update' name="update_image" value="Update Image">

			<div class="clear"></div>
		</form>

<!-- End uploading image -->

	</div>

</div>

<!-- error and sucess fadeout after delayed second -->
<script type="text/javascript">
	//$( "div.dist-error" ).slideUp( 300 ).delay( 800 ).fadeIn( 400 );
	$( document ).ready(function() {
	    $("div.dist-error").delay(4000).fadeOut("slow");
	    $("div.dist-success").delay(4000).fadeOut("slow");
	});
</script>
