<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_latestnews/css/mod_latestnews.css');

$user = JFactory::getUser();

foreach ( $cat_news as $cat_result );

$app = JFactory::getApplication();

$menu_id = $app->getMenu()->getActive()->id;

$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select($db->quoteName(array('id', 'title', 'alias', 'published', 'path')));
$query->from($db->quoteName('#__menu'));
$query->where($db->quoteName('id') . ' LIKE '. $menu_id);
$db->setQuery($query);

$menu_result = $db->loadObjectList();

foreach($menu_result as $result);

?>

<h1 class="latest-news">Latest News</h1>
<div class="latest-divider"> </div>
                   
<?php foreach ( $article_news as $art_result) { ?>
<?php 
	$state = $art_result->state;
	if($state=='1'){
?>
	<div class='latest-news--content'>
		<p class='lnews-date'><?php echo JText::sprintf(JHTML::_('date',$art_result->created, JText::_('DATE_FORMAT_LC2_DATE'))); ?></p>
		<?php if(!$user->guest){ ?>
			<!-- the path is already dynamic -->
			<h4><a href="<?php echo $result->path; ?>/<?php echo $art_result->id; ?>-<?php echo $art_result->alias;?>"><?php  echo $art_result->title; ?></a></h4>
		<?php }else{ ?>
			<h4 class="ln-result--anchor"><?php  echo $art_result->title; ?></h4>
		<?php } ?>
	</div>
<?php }else{ } ?>
<?php } ?>

	
