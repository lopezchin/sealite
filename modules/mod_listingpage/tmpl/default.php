<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_listingpage/css/mod_listingpage.css');
$doc->addScript(JURI::root().'/modules/mod_listingpage/js/tooltip.js');
$app = JFactory::getApplication();

$menu = $app->getMenu()->getActive();

$user = JFactory::getUser();
$current_user = $user->id;

?>

<?php if($cat_news != "" || $cat_news != null ){ 
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

						//use this to get the image size
						// $imgSize = filesize(htmlspecialchars($images->image_intro));
						// $totalSize = ($imgSize/1048576)*1000; //mega
						//$totalSize = ($imgSize/1024)*1000; //kilo

						// if($totalSize == 0){
						// 	$totalFileSize = 0; 
						// }else{
						// 	$totalFileSize =  round($totalSize, 2);
						// }

						$ext = substr($imageUrl, strrpos($imageUrl, '.') + 1);

						$extensions = array("pdf","PDF");

						// if (!in_array($ext, $extensions)) {
						//        echo "$ext is an invalid file format" ;
						// }else{
						// 	echo "$ext is a valid format";
						// }

						if($imageUrl == null || $imageUrl == ''){
							$cValue = 'no-img';
							$none = "imgDisplay";
						}else{
							$cValue = "";
							$none = "";
						}
						
						
					?> <!-- to get image by jsoncode -->

					<div class="mb-content">
						<div class="mb-detail <?php echo $cValue ?>">
						<h1><?php  echo $art_result->title; ?></h1>
							<?php echo $art_result->introtext; ?>
						</div>

						<a class="sendEmail tooltip" data-currentuserid="<?php echo $current_user; ?>" data-currentimagename="<?php echo $imgName; ?>" 
							download="<?php echo $imgName; ?>" title="<?php echo $imgName; ?>" href="<?php echo $imageUrl; ?>">

							<?php if (!in_array($ext, $extensions)) { ?>
						       	<img class="<?php echo $none; ?>" src="<?php echo $imageUrl; ?>" alt="<?php echo $imgName; ?>">
								<?php }else{ ?>
										<img class="<?php echo $none; ?>" src="modules/mod_listingpage/images/pdf-2.jpg">
								<? } ?>
								
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
<?php }else{ ?>
	<div class="main-body">
		<div class="mb-title">Select Specific Category First.</div>
		<div class="mb-main--cont">
			<div class="mb-content">
				<div class="mb-detail?>">

				</div>
			</div>
		</div>
	</div>
<?php } ?>


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
</script>