<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<<<<<<< HEAD






=======
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">New Cannabis Review</h1>
			<ul class="bread_crumb">
				<li>
					<a href="?page=home" title="Home">
						Home
					</a>
				</li>
				<li class="separator icon_small_arrow right_gray">
					&nbsp;
				</li>
				<li>
					New Cannabis Review
				</li>
			</ul>
		</div>
		<div class="page_header_right">
			<!--form class="search">
				<input class="search_input hint" type="text" value="To search type and hit enter..." placeholder="To search type and hit enter...">
			</form-->
		</div>
	</div>

	<div class="clearfix page_margin_top ">

<<<<<<< HEAD

<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
=======
<a title="Read more"  href="<?php echo $this->webroot;?>users/dashboard" class="more large dark_blue icon_small_arrow margin_right_white">Dashboard</a>
<a title="Read more"  href="<?php echo $this->webroot;?>users/settings" class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">Settings</a>
<a title="Read more" href="<?php echo $this->webroot;?>review"  class="active more large dark_blue icon_small_arrow margin_right_white margin_left_10">Add Review</a>
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
<a title="Read more" href="<?php echo $this->webroot;?>review/all"  class="more large dark_blue icon_small_arrow margin_right_white margin_left_10">My Review</a>
<div class="clearfix"></div>




<form class="page_margin_top" action="" method="post" id="reviews1" >



<fieldset id="qf_review__general" class="qf-fieldset">

<<<<<<< HEAD
<h2 class="box_header slide page_margin_top">
=======
<h2 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
General Rating
</h2>


<div id="qf_review__general__mscale__wrapper" class="qf-input-wrapper qf-slider-input-wrapper">
    <span id="qf_review__general__mscale__label_span" class="qf-label-span">
        <label id="qf_review__general__mscale__label" for="qf_review__general__mscale">Effect Scale (Active to Sedative)</label>
    </span>
    <span id="qf_review__general__mscale__span" class="qf-input-span qf-slider-input-span">
        <p id="qf_review__general__mscale__prompt">Extremely Active</p>
        <div>
            <input id="qf_review__general__mscale" class="qf-hidden-input qf-slider qf-input" type="hidden" name="eff_scale" value="1" title="Effect Scale (Active to Sedative)"/>
        </div>
        <div id="qf_review__general__mscale__slider" class="qf-slider-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
        </div>
    </span>
</div>

<div id="qf_review__general__strength__wrapper" class="qf-input-wrapper qf-slider-input-wrapper">
    <span id="qf_review__general__strength__label_span" class="qf-label-span">
        <label id="qf_review__general__strength__label" for="qf_review__general__strength">Effect Strength</label>
    </span>
    <span id="qf_review__general__strength__span" class="qf-input-span qf-slider-input-span">
        <p id="qf_review__general__strength__prompt">1/10</p>
    <div>
        <input id="qf_review__general__strength" class="qf-hidden-input qf-slider qf-input" type="hidden" name="eff_strength" value="1" title="Effect Strength">
    </div>
    <div id="qf_review__general__strength__slider" class="qf-slider-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
    </div>
    </span>
</div>
<div id="qf_review__general__duration__wrapper" class="qf-input-wrapper qf-slider-input-wrapper">
    <span id="qf_review__general__duration__label_span" class="qf-label-span">
        <label id="qf_review__general__duration__label" for="qf_review__general__duration">Effect Duration</label>
    </span>
    <span id="qf_review__general__duration__span" class="qf-input-span qf-slider-input-span">
    <p id="qf_review__general__duration__prompt">1 hr</p>
    <div>
        <input id="qf_review__general__duration" class="qf-hidden-input qf-slider qf-input" type="hidden" name="eff_duration" value="1" title="Effect Duration">
    </div>
    <div id="qf_review__general__duration__slider" class="qf-slider-bar ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
    </div>
    </span>
</div>
</fieldset>

<div class="clear"> </div>


<fieldset id="qf_review__effects" class="qf-fieldset">

<<<<<<< HEAD
<h2 class="box_header slide page_margin_top">
=======
<h2 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Effects Rating
</h2>

<div class="clear"> </div>


<<<<<<< HEAD
<h3 class="box_header slide page_margin_top">
=======
<h3 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Medicinal Effects
</h3>


<p>How well did this strain help your medical condition(s)?</p>

<span id="qf_review__effects__medical__inner">
<?php foreach($symptoms as $effect)
{
?>
<<<<<<< HEAD
<a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel');" title="<?php echo $effect['Symptom']['id'];?>" class="btn qf_review__effects__medical"><?php echo ucfirst($effect['Symptom']['title']);?></a>
=======
<a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel');" title="<?php echo $effect['Symptom']['id'];?>" class="eff3 btn qf_review__effects__medical"><?php echo ucfirst($effect['Symptom']['title']);?></a>
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
<?php
}
?>
</span>

<div class="clear"></div>

<<<<<<< HEAD
<h3 class="box_header slide page_margin_top">
=======
<h3 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Positive Effects
</h3>

<p>What positive effect(s) did this strain have on you?</p>

<span id="qf_review__effects__positive__inner">
<?php foreach($effects as $effect)
<<<<<<< HEAD
{?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="btn qf_review__effects__positive"><?php echo ucfirst($effect['Effect']['title']);?></a>
=======
{?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="eff3 btn qf_review__effects__positive"><?php echo ucfirst($effect['Effect']['title']);?></a>
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
<?php }
?>
</span>

<<<<<<< HEAD
<h3 class="box_header slide page_margin_top">
=======
<h3 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Negative Effects
</h3>

<p>What negative effect(s) did this strain have on you?</p>


<span id="qf_review__effects__negative__inner">


<?php foreach($negative as $effect)
<<<<<<< HEAD
{?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="btn btn-info qf_review__effects__negative"><?php echo ucfirst($effect['Effect']['title']);?></a>
=======
{?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="eff3 btn btn-info qf_review__effects__negative"><?php echo ucfirst($effect['Effect']['title']);?></a>
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
<?php }
?>


</span>

</fieldset>


<fieldset id="qf_review__aesthetics" class="qf-fieldset">

<<<<<<< HEAD
<h2 class="box_header slide page_margin_top">
=======
<h2 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Aesthetic Rating
</h2>




<<<<<<< HEAD
<h3 class="box_header slide page_margin_top">
=======
<h3 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Color
</h3>


<p>What color(s) stand out in this bud?</p>

<span  id="qf_review__aesthetics__color__inner">
<?php foreach($colours as $colour)
{?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $colour['Colour']['id'];?>" class="eff3 btn btn-info qf_review__aesthetics__color"><?php echo ucfirst($colour['Colour']['title']);?></a>
<?php }
?>


</span>




<div class="clear"> </div>

<<<<<<< HEAD
<h3 class="box_header slide page_margin_top">
=======
<h3 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Flavor / Scent
</h3>



<p>How does this strain taste & smell?</p>

<span id="qf_review__aesthetics__flavor__inner">
<?php foreach($flavors as $flavor)
{?> <a href="javascript:void(0);" onclick="($(this).hasClass('sel'))?$(this).removeClass('sel'):$(this).addClass('sel')" title="<?php echo $flavor['Flavor']['id'];?>" class="eff3 btn btn-info qf_review__aesthetics__flavor"><?php echo ucfirst($flavor['Flavor']['title']);?></a>
<?php }
?>



</span>



</fieldset>



<<<<<<< HEAD
<h2 class="box_header slide page_margin_top">
=======
<h2 class="slide page_margin_top">
>>>>>>> c86d1e6f6cce31fb6f7b1a4e935b7e3c4471fe1a
Comments, etc.
</h2>

<p>Overall Rating*</p>


<div id="preci">
<div id="precision" class="left" style="cursor: pointer;" ></div>
<div class="errorz" style="display: none;" >Overall Rating Is Mandatory.</div>
</div>

<p id="qf_review__other__overall__prompt">1/10</p>

<input title="Overall Rating" value="0" type="hidden" name="rate" id="qf_review__other__overall" class="qf-hidden-input qf-slider qf-input"/>

<div class="qf-slider-bar" id="qf_review__other__overall__slider"> </div>



<p>Final Thoughts*</p>


<textarea title="Comments" rows="8" maxlength="4000" name="review" id="qf_review__other__comments" class="qf-maxlength-4000 qf-required qf-textarea" required="required"></textarea>

<div class="submit">
<input type="submit" name="submit" value="Save My Review" class="button more blue"/>
</div>



</form>

</div>
</div>






<script>
$(function(){
    $('#reviews1').submit(function(){
        if($('#qf_review__other__overall').val()=='0')
        {
            $('.errorz').show();
            return false;
        }
        else
        {
            $('.errorz').hide();
            return true;
        }
            
    });

               	$('.qf_review__effects__medical').click(function() {
					addSlider($(this), 'medical');
				});
                $('.qf_review__aesthetics__color').click(function() {
					addSlider($(this), 'color');
				});
				$('.qf_review__aesthetics__flavor').click(function() {
					addSlider($(this), 'flavor');
				});
   	            $('.qf_review__effects__positive').click(function() {
					addSlider($(this), 'positive');
				});
				$('.qf_review__effects__negative').click(function() {
					addSlider($(this), 'negative');
				});

                
				function addSlider(jQ, type) {
                    var sel = jQ.attr('title');
					if (sel <= 0) return false;
					var opt = jQ.find('option:selected');
                    var txt = jQ.text();
					var id = type+sel;
					var h = "";
					if ($('#'+id).length != 0) {
						opt.removeClass("selected");
						$('#'+id).remove();
					} else {
						opt.addClass("selected");
						var cat = (type == 'color' || type == 'flavor') ? 'aesthetics' : 'effects';
                        if(cat == 'aesthetics')
                            h = "display:none";
						var innerId = '#qf_review__'+cat+'__'+type+'__inner';
                        if(type == 'positive' || type == 'negative')
                            type = 'effect';
                            
						$(innerId).append('<div id="'+id+'" class="review-slider" style="'+h+'"><label>'+txt+'</label><input type="hidden" id="'+id+'i" name="'+type+'['+sel+']" value="0" /><div class="slider"  id="'+id+'s"></div><p id="'+id+'p" >0/10</p><div class="clear"> </div></div>');
						$('#'+id+'s').slider({
							range: "min",
							value: 0,
							min: 0,
							max: 10,
							slide: function( event, ui ) {
								$('#'+id+'p').html(''+ui.value+'/10');
								$('#'+id+'i').val(ui.value);
							}
						});
					}
					jQ.val("");
				}
                $("#qf_review__general__mscale__slider").slider({'min':1,'max':9,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__general__mscale').val(ui.value);var vals = ['Extremely Active','Very Active','Active','Bit Active','Balanced','Bit Sedate','Sedate','Very Sedate','Extemely Sedate'];$('#qf_review__general__mscale__prompt').html(vals[Math.ceil( ((ui.value+1-1)/(9+1-1))*vals.length )-1]); },'range':'min'});		
				$("#qf_review__general__strength__slider").slider({'min':1,'max':10,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__general__strength').val(ui.value);$('#qf_review__general__strength__prompt').html(''+ui.value+'/10'); },'range':'min'});		
				$("#qf_review__general__duration__slider").slider({'min':1,'max':6,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__general__duration').val(ui.value);$('#qf_review__general__duration__prompt').html(''+ui.value+' hrs'); },'range':'min'});		
				$("#qf_review__aesthetics__hairs__slider").slider({'min':1,'max':10,'step':1,'value':5,'slide':function(e,ui){ $('#qf_review__aesthetics__hairs').val(ui.value);$('#qf_review__aesthetics__hairs__prompt').html(''+ui.value+'/10'); },'range':'min'});		
				$("#qf_review__aesthetics__crystals__slider").slider({'min':1,'max':10,'step':1,'value':5,'slide':function(e,ui){ $('#qf_review__aesthetics__crystals').val(ui.value);$('#qf_review__aesthetics__crystals__prompt').html(''+ui.value+'/10'); },'range':'min'});		
		
			$('#precision').raty({
                  cancel     : false,
                  cancelOff  : 'cancel-off.png',
                  cancelOn   : 'cancel-on.png',
                  path       : '<?php echo $this->webroot;?>raty/images',
                  starHalf   : 'star-half.png',
                  starOff    : 'star-off.png',
                  starOn     : 'star-on.png',
                  target     : '#qf_review__other__overall__prompt',
                  targetKeep : true,
                  precision  : false,
                  number     : 10,
                  hints      : ['1/10','2/10','3/10','4/10','5/10','6/10','7/10','8/10','9/10','10/10'],
                  click      : function(score){
                                    $('#qf_review__other__overall').val(score.toFixed(2));
                                    $('.errorz').hide();
                    }
    });

});
</script>