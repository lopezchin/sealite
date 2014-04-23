<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributorcredential/css/mod_distributorcredential.css');

$user = JFactory::getUser();

$disID=$user->id;


$db = JFactory::getDbo();
$query = $db->getQuery(true);
// Order it by the ordering field.
$query->select($db->quoteName(array('id', 'company', 'name', 'saleterritory', 'address', 'phone', 'fax', 'cellphone', 'email')));
$query->from($db->quoteName('#__users'));
$query->where($db->quoteName('id') . ' LIKE '. $disID);
// Reset the query using our newly populated query object.
$db->setQuery($query);
// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();

foreach ($results as $result);

?>	

<div class="discres-container">
	<div class="discres-title">
		<span>Sealite Distributor Portal - Sealite Pty Ltd</span>
	</div>
	<div class="dscres-detail--cont">
		<div class="image-detail dis-left">
			<img src="<?php echo !$user->guest ? $user->image : 'Sealite guest'; ?>" width="160" height="160">
		</div>

		<div class="detail-1st dis-left">										
			<p class="companytitle"><?php echo !$user->guest ? $result->company : 'Sealite guest'; ?></p>
			<p><b>Logged In: </b><?php echo !$user->guest ? $result->name : 'Sealite guest'; ?></p>
			<p><b>Phone: </b><?php echo !$user->guest ? $result->phone : 'Sealite guest'; ?></p>
			<p><b>Cell Phone: </b><?php echo !$user->guest ? $result->cellphone : 'Sealite guest'; ?></p>
			<p><b>Fax: </b><?php echo !$user->guest ? $result->fax : 'Sealite guest'; ?></p>
			<p><b>Email: </b><?php echo !$user->guest ? $result->email : 'Sealite guest'; ?></p>
		</div>

		<div class="detail-2nd dis-left">										
			<p><b>Company Name: </b><?php echo !$user->guest ? $result->company : ''; ?></p>
			<p><b>Address: </b><?php echo !$user->guest ? $result->address : 'Sealite guest'; ?></p>
			<p><b>Sale Territory: </b><?php echo !$user->guest ? $result->saleterritory : 'Sealite guest'; ?></p>
			<!-- <p> <a href="component/users/profile?layout=edit"><button class='dis-left'>Change Password</button></a> <a href=""><button class='dis-left'>Report Issue</button> </p></a> -->
			<p> <a href="#" class="dis-toggle"><button class='dis-left'>Change Password</button></a> <a href=""><button class='dis-left'>Report Issue</button> </p></a>
		</div>
	</div>
	<div class="clear"></div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
    //init page    
    $(".dis-toggle").live("click", function() {
        $(".dis-form").addClass("form_hide").show();
        $(".dis-form2").addClass("form_show").show();
    });

});

</script>


