<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_listingpage/css/mod_listingpage.css');
$app = JFactory::getApplication();

$menu = $app->getMenu()->getActive();

$user = JFactory::getUser();
$current_user = $user->id;

foreach ( $cat_news as $cat_result );

?>
<div class="main-body">
	<div class="mb-title"><?php  echo $menu->title; ?> </div>
	<div class="mb-main--cont">
			<?php foreach ( $article_news as $art_result ){ ?>
			
				<?php if($art_result->state == '1'){ ?>

				<?php 	
					$images = json_decode($art_result->images); 					
					$imageUrl = htmlspecialchars($images->image_intro);
					$imgName = htmlspecialchars($images->image_intro_alt);
					$imgSize = filesize(htmlspecialchars($images->image_intro));
					$totalSize = ($imgSize/1048576)*1000; //mega
					//$totalSize = ($imgSize/1024)*1000; //kilo

					if($imageUrl == null || $imageUrl == ''){
						$cValue = 'no-img';
						$none = "imgDisplay";
					}else{
						$cValue = "";
						$none = "";
					}
					
					if($totalSize == 0){
						$totalFileSize = 0; 
					}else{
						$totalFileSize =  round($totalSize, 2);
					}

				?> <!-- to get image by jsoncode -->

				<div class="mb-content">
					<div class="mb-detail <?php echo $cValue ?>">
					<h1><?php  echo $art_result->title; ?></h1>
						<?php echo $art_result->introtext; ?>
					</div>

					<a class="sendEmail" data-currentuserid="<?php echo $current_user; ?>" data-currentimagename="<?php echo $imgName; ?>" download="<?php echo $imgName; ?>" title="<?php echo $imgName; ?> ( <?php  echo $totalFileSize; ?> MB )" href="<?php echo $imageUrl; ?>">
						<img class="<?php echo $none; ?>" src="<?php echo $imageUrl; ?>" alt="<?php echo $imgName; ?>">
					</a>
					<div class="lpclear"></div>
					<!-- <div class="gfbemail <?php echo $none; ?>">
						<a href="#">get file by email</a> [ powerpoint <?php  echo $totalFileSize; ?> MB ]
					</div> -->
				</div>
				<?php }else{ ?>
					
				<?php } ?>
			<?php } ?>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$(".sendEmail").click(function(){

			var currentuserid = $(this).data('currentuserid');
			var currentimagename = $(this).data('currentimagename');

			//alert(currentimagename+' '+currentuserid);
				$.ajax({
					type: 'POST',
					url: 'http://localhost/sealite/dealer/corporate-presentation',
					data: {
						'current_uid': currentuserid,
						'current_image_name': currentimagename,
						'_token': "",
						'action': 'send_mail'
					}
					
		 		});
	 		});
	});
 		
 //    $('#sendEmail').click(function(){

 //    	var user_name = $('#user_name').val();
 //    	var user_email = $('#user_email').val();

 		// alert(user_name+"/"+user_email);

    // var link = 'mailto:philweb.seniorprogrammer05@gmail.com?subject=Message from '
    //          +document.getElementById('user_name').value
    //          +'&body='+document.getElementById('user_email').value;
	    // window.location.href = link;
	// });


</script>