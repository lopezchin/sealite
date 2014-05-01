<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributor_form/css/mod_distributor_form.css');

$user = JFactory::getUser();

$disID=$user->id;

?>

<div class="distributor_form_container">
	<div class="disform--title">
		<span>Change Password</span>

	</div>
	<div class="distibutor-form">
		<form name='dis-form' id='dis-form' class="" method='POST'>	
			<div class="field">
				<div><label for='password'>New Password</label></div>
				<div><input type='password' name='password' id='password' placeholder="Password" /></div>
			</div>
			<div class="field">
				<div><label for='confirm-password'>Confirm Password</label></div>
				<div><input type='password' name='confirmPassword' id='confirmPassword' placeholder="Confirm Password" /></div>
			</div>
			<div class="field">
				<div><label for='verificatoin-code'>Verification Password</label></div>
				<div><input type='text' name='verification' id='verification' placeholder="Verification Code" /></div>
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


<script type="text/javascript">
	//$( "div.dist-error" ).slideUp( 300 ).delay( 800 ).fadeIn( 400 );
	$( document ).ready(function() {
	    $("div.dist-error").delay(4000).fadeOut("slow");
	});
</script>