<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_listingpage/css/mod_listingpage.css');
$app = JFactory::getApplication();

$menu = $app->getMenu()->getActive();


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
					$imgSize = filesize(htmlspecialchars($images->image_intro));
					// $totalSize = ($imgSize/1048576)*1000; //mega
					//$totalSize = ($imgSize/1024)*1000; //kilo

					if($imageUrl == null || $imageUrl == ''){
						$cValue = 'no-img';
						$none = "imgDisplay";
					}else{
						$cValue = "";
						$none = "";
					}
					
					// if($totalSize == 0){
					// 	$totalFileSize = 0; 
					// }else{
					// 	$totalFileSize =  round($totalSize, 2);
					// }

				?> <!-- to get image by jsoncode -->

				<div class="mb-content">
					<div class="mb-detail <?php echo $cValue ?>">
					<h1><?php  echo $art_result->title; ?></h1>
						<?php echo $art_result->introtext; ?>
					</div>
					<img class="<?php echo $none; ?>" src="<?php echo $imageUrl; ?>" alt="add image on admin">

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