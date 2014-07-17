<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_adv_slider/css/mod_adv_slider.css');
$doc->addScript(JURI::root().'/modules/mod_adv_slider/js/jquery-1.4.4.min.js');
$doc->addScript(JURI::root().'/modules/mod_adv_slider/js/jsCarousel-2.0.0.js');

?>

<script type="text/javascript">

	$(document).ready(function() {
	    $('#carouselv').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: false, itemstodisplay: 3, orientation: 'v' });
	    $('#carouselh').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: false, masked: false, itemstodisplay: 5, orientation: 'h' });
	    $('#carouselhAuto').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: true, itemstodisplay: 5, orientation: 'h' });
	});       
    
</script>


<div id="contents">

    <div id="v2">

        <div id="demo-wrapper">

            <div id="demo-left">

                <div id="vWrapper">

                    <div id="carouselv">

                        <div>

                            <img alt="" src="images/img_1.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_2.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_3.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_4.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_5.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_6.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_7.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_8.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_9.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_10.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_11.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_12.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_13.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_14.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_15.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                        <div>

                            <img alt="" src="images/img_16.jpg" /><br />

                            <span class="thumbnail-text">Image Text</span></div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
