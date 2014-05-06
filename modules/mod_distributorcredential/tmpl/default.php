<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributorcredential/css/mod_distributorcredential.css');

$user = JFactory::getUser();

$disID=$user->id;


$db = JFactory::getDbo();
$query = $db->getQuery(true);
// Order it by the ordering field.
$query->select($db->quoteName(array('id', 'company', 'name', 'saleterritory', 'address', 'phone', 'fax', 'cellphone', 'email', 'image')));
$query->from($db->quoteName('#__users'));
$query->where($db->quoteName('id') . ' LIKE '. $disID);
// Reset the query using our newly populated query object.
$db->setQuery($query);
// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();

foreach ($results as $result);

$image = $result->image;

if($image!='' && $image!=null){
	$image = 'images/user-avatar/'.$result->image;
}else{
	$image = 'modules/mod_distributorcredential/images/profile-icon.png';
}

?>	

<div class="discres-container">
	<div class="discres-title">
		<span>Sealite Distributor Portal - Sealite Pty Ltd</span>
	</div>
	<div class="dscres-detail--cont">
		<div class="image-detail dis-left">
			<a href="#" class="dis-toggle-image click" ><img src="<?php echo $image; ?>" width="160" height="160" alt="<?php echo $result->image; ?>"></a>
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
			<p> <a href="#" class="dis-toggle-password"><button class='dis-left dis-form'>Change Password</button></a> 
				<a href="#" class="dis-toggle-update"><button class='dis-left dis-form2'>Update Detail Issue</button></a>
			</p>
		</div>
	</div>

	<div class='popup'>
		<div class='content'>
			<!-- <img src='http://www.developertips.net/demos/popup-dialog/img/x.png' alt='quit' class='x' id='x' /> -->
			<a href="" class="x" id="x">X</a>
			<!-- <p>
			Welcome to Aspdotnet-Suresh.com. Please use above search option which was there in top right side to get help with many of articles.
			<br/>
			<br/>
			<a href='' class='close'>Close</a>
			</p> -->

			<form name='dis-form' id='dis-form' class="" method='POST' enctype="multipart/form-data">		

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
		</div>
	</div> 

	<div class="clear"></div>
</div>


<!-- this script continue to mo_distributorcredential -->
<script type="text/javascript">
	$(document).ready(function() {
    //init page    
    $(".dis-toggle-password").live("click", function() {
        $(".dis-form").addClass("form_hide").show();
        $(".dis-form2").addClass("form_show").show();

        $(".dis-form").removeClass("form_show").hide();
    });  


    $(".dis-toggle-update").live("click", function() {
    	$(".dis-form").addClass("form_show").show();

        $(".dis-form").removeClass("form_hide").hide();
        $(".dis-form2").removeClass("form_show").hide();


        // $(".dis-form2").removeClass("form_show").hide();
    });

    $(function(){
		var overlay = $('<div id="overlay"></div>');
		$('.close').click(function(){
		$('.popup').hide();
			overlay.appendTo(document.body).remove();
			return false;
		});

		$('.x').click(function(){
		$('.popup').hide();
			overlay.appendTo(document.body).remove();
			return false;
		});

		$('.click').click(function(){
			overlay.show();
			overlay.appendTo(document.body);
			$('.popup').show();
			return false;
		});
	});

    // $(".dis-toggle-image").live("click", function() {
    //     $(".dis-form").addClass("form_hide").show();
    //     $(".dis-form3").addClass("form_show").show();


    //     $(".dis-form2").removeClass("form_show").hide();
    // });

});

</script>


