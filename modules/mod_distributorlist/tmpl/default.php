<?php
defined('_JEXEC') or die('Access Deny');
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_distributorlist/css/mod_distributorlist.css');
$doc->addScript(JURI::root().'/modules/mod_distributorlist/js/mod_distributorlist.js');
 
?>

<form name='distributor-listing' id='distributor-listing' method='post' action=''>
	<div class='distributor'>
		<p>Select Distributor</p>
		<select id='dist-list' class='dist-list' name="dist-list">
			<option value="new distributor">new distributor</option>
			<?php  foreach ( $distlisting as $result  ) { ?>
				<option value="<?php echo $result->id; ?>"><?php echo $result->name; ?></option>
			<?php } ?>
		</select>
		<div class='dist-opt--btn'>
			<input type='submit' id='select-dist' class='dist-opt--save' name='save' value='Save' /><input type='submit' class='dist-opt--cancel' value='cancel' value='Cancel' />
		</div>

	</div>
</form>


<?php //echo $list ?>    
