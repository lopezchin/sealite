<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_eventlisting/css/mod_eventlisting.css');

// foreach ( $cat_news as $cat_result );

?>

<?php if($cat_news != "" || $cat_news != null ){ 
	foreach ( $cat_news as $cat_result );
?>

<div class="event-listing">
	<div class="sorter">
		<div class="event-listing--title event-left">
			<span>Upcoming Events</span>
		</div>
		<div class="event-sorting--opt event-right">
			<input type="text" class="search"  value="Search..." onblur="if (this.value=='') this.value='Search...';" onfocus="if (this.value=='Search...') this.value='';"/>
			<select class="sorted--off">
				<option>Sort by: Name</option>
			</select>
		</div>
		<div class="clear"></div>
	</div>

	<div class="event-detail">
		
			<?php foreach ( $article_news as $art_result ){ ?>
			<!--<?php echo JText::sprintf(JHTML::_('date',$art_result->created, JText::_('DATE_FORMAT_LC2_MONTH'))); ?> -->
				<?php if($art_result->state == '1'){ ?>
					<?php 
						$month = JText::sprintf(JHTML::_('date',$art_result->created, JText::_('DATE_FORMAT_LC2_MONTH'))); 

						if(date("M") != $month){ 
							$current_month = 'el-date-month-black';
						}else{
							$current_month = 'el-date-month';
						}
					?>
					
					<div class="event--list">
						<div class="el-date event-left">
							<div class="<?php echo $current_month; ?>"><?php echo JText::sprintf(JHTML::_('date',$art_result->created, JText::_('DATE_FORMAT_LC2_DATE_MONTH'))); ?></div>
							<div class="el-year"><?php echo JText::sprintf(JHTML::_('date',$art_result->created, JText::_('DATE_FORMAT_LC2_YEAR'))); ?></div>
						</div>
						<div class="event-list--content event-left">
							<span class="evc-title"><?php  echo $art_result->title; ?></span>
							<p>
								<?php echo $art_result->introtext; ?>
							</p>
						</div>
						<div class="clear"></div>
					</div>
				<?php }else{ ?>
						
						
				<?php } ?>
			<?php } ?>
	</div>
</div>


<?php }else{ ?>
	<div class="event-listing">
	<div class="sorter">
		<div class="event-listing--title event-left">
			<span>Select specific categories for event.</span>
		</div>

		<div class="clear"></div>
	</div>

	<div class="event-detail">
		
	</div>
</div>
<?php } ?>