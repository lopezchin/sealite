<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_recenttitle/css/mod_recenttitle.css');

if($hello==''){ ?>
	

<?php }else{ ?>

	<div class='rtitle--head'>
		<p class="rtitle"><?php  echo $hello; ?></p>
	</div>

<?php } ?>
