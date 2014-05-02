<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_latestnews/css/mod_latestnews.css');
$doc->addScript(JURI::root().'/modules/mod_latestnews/js/mod_latestnews.js');

$user = JFactory::getUser();

foreach ( $cat_news as $cat_result );

?>
<div class="l-news--container">
	<h1 class="latest-news">Latest News</h1>
	<div class="latest-divider"> </div>
	<?php //echo $cat_result->alias; ?>
	<div class="lnews-container" id ="marqueecontainer" >
		<div class="lnews-content" id="vmarquee" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">                 
	                           
			<?php foreach ( $article_news as $art_result) { ?>
				<?php 
					$state = $art_result->state;
					if($state=='1'){
				?>
					<div class='latest-news--content'>
						<p class='lnews-date'><?php echo JText::sprintf(JHTML::_('date',$art_result->created, JText::_('DATE_FORMAT_LC2_DATE'))); ?></p>
						<?php if(!$user->guest){ ?>
							<!-- static add the link with path -->
							<h4><a href="dealer/event/<?php echo $cat_result->path; ?>-list/<?php echo $art_result->id; ?>-<?php echo $art_result->alias;?>"><?php  echo $art_result->title; ?></a></h4>
						<?php }else{ ?>
							<h4 class="ln-result--anchor"><?php  echo $art_result->title; ?></h4>
						<?php } ?>
					</div>
				<?php }else{ } ?>
			<?php } ?>

	 	</div>              
	</div> 
</div>
