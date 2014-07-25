<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<style>
.sel{text-decoration:none;}
</style>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />
<form action="" method="post" id="reviews1" >
<fieldset id="qf_review__general" class="qf-fieldset">
<legend>GENERAL RATING</legend>
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
<fieldset id="qf_review__effects" class="qf-fieldset">
<legend>Effect Ratings</legend>
<div class="qf-select-wrapper" id="qf_review__effects__medical__wrapper">
<span class="qf-label-span" id="qf_review__effects__medical__label_span">
<label id="qf_review__effects__medical__label" for="qf_review__effects__medical">Medicinal Effects</label>
<p style="font-size: 9pt; color: #666; margin: 0 0 2px">How well did this strain help your medical condition(s)?</p>
</span>
<span class="qf-select-span" id="qf_review__effects__medical__span">
<span class="qf-select-inner" id="qf_review__effects__medical__inner">
<div class="qf-select review-selector" id="qf_review__effects__medical">
<?php foreach($symptoms as $effect)
{?> <a href="javascript:void(0);" onclick="$(this).addClass('sel')" title="<?php echo $effect['Symptom']['id'];?>" class="btn btn-info qf_review__effects__medical"><?php echo ucfirst($effect['Symptom']['title']);?></a>
<?php }
?>
</div>
<!--<select title="Medicinal Effects" class="qf-select review-selector" name="review__effects__medical" id="qf_review__effects__medical">
<option value="">Select one or more conditions to rate</option>
<?php foreach($symptoms as $effect)
{?> 
    <option value="<?php echo $effect['Symptom']['id'];?>" class="qf-option"><?php echo $effect['Symptom']['title'];?></option>
<?php }
?>
</select>-->
</span>
</span>
</div>
<div>
<div class="clear"> </div>
</div>
<div class="qf-select-wrapper" id="qf_review__effects__positive__wrapper">
<span class="qf-label-span" id="qf_review__effects__positive__label_span">
<label id="qf_review__effects__positive__label" for="qf_review__effects__positive">Positive Effects</label>
<p style="font-size: 9pt; color: #666; margin: 0 0 2px">What positive effect(s) did this strain have on you?</p>
</span>
<span class="qf-select-span" id="qf_review__effects__positive__span">
<span class="qf-select-inner" id="qf_review__effects__positive__inner">
<div class="qf-select review-selector" id="qf_review__effects__positive">
<?php foreach($effects as $effect)
{?> <a href="javascript:void(0);" onclick="$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="btn btn-info qf_review__effects__positive"><?php echo ucfirst($effect['Effect']['title']);?></a>
<?php }
?>
</div>
<!--
<select title="Positive Effects" class="qf-select review-selector" name="review__effects__positive" id="qf_review__effects__positive">
<option value="" class="qf-option">Select one or more effects to rate</option>
<?php foreach($effects as $effect)
{?> 
    <option value="<?php echo $effect['Effect']['id'];?>" class="qf-option"><?php echo $effect['Effect']['title'];?></option>
<?php }
?>
</select>-->
</span>
</span>
</div>
<div>
<div class="clear"> </div>
</div>
<div class="qf-select-wrapper" id="qf_review__effects__negative__wrapper">
<span class="qf-label-span" id="qf_review__effects__negative__label_span">
<label id="qf_review__effects__negative__label" for="qf_review__effects__negative">Negative Effects</label>
<p style="font-size: 9pt; color: #666; margin: 0 0 2px">What negative effect(s) did this strain have on you?</p>
</span>
<span class="qf-select-span" id="qf_review__effects__negative__span">
<span class="qf-select-inner" id="qf_review__effects__negative__inner">
<div class="qf-select review-selector" id="qf_review__effects__negative">
<?php foreach($negative as $effect)
{?> <a href="javascript:void(0);" onclick="$(this).addClass('sel')" title="<?php echo $effect['Effect']['id'];?>" class="btn btn-info qf_review__effects__negative"><?php echo ucfirst($effect['Effect']['title']);?></a>
<?php }
?>
</div>
<!--
<select title="Negative Effects" class="qf-select review-selector" name="review__effects__negative" id="qf_review__effects__negative">
<option value="" class="qf-option">Select one or more effects to rate</option>
<?php foreach($negative as $effect)
{?> 
    <option value="<?php echo $effect['Effect']['id'];?>" class="qf-option"><?php echo $effect['Effect']['title'];?></option>
<?php }
?>
</select>-->
</span>
</span>
</div>
</fieldset>
<fieldset id="qf_review__aesthetics" class="qf-fieldset">
<legend>Aesthetic Rating</legend>
<!--
<div class="qf-input-wrapper qf-slider-input-wrapper" id="qf_review__aesthetics__hairs__wrapper">
<span class="qf-label-span" id="qf_review__aesthetics__hairs__label_span">
<label id="qf_review__aesthetics__hairs__label" for="qf_review__aesthetics__hairs">Hairs</label>
</span>
<span class="qf-input-span qf-slider-input-span" id="qf_review__aesthetics__hairs__span">
<p id="qf_review__aesthetics__hairs__prompt">5/10</p>
<div>
<input title="Hairs" value="5" type="hidden" name="hairs" id="qf_review__aesthetics__hairs" class="qf-hidden-input qf-slider qf-input"/>
</div>
<div class="qf-slider-bar" id="qf_review__aesthetics__hairs__slider"> </div>
</span>
</div>
<div class="qf-input-wrapper qf-slider-input-wrapper" id="qf_review__aesthetics__crystals__wrapper">
<span class="qf-label-span" id="qf_review__aesthetics__crystals__label_span">
<label id="qf_review__aesthetics__crystals__label" for="qf_review__aesthetics__crystals">Crystals</label>
</span>
<span class="qf-input-span qf-slider-input-span" id="qf_review__aesthetics__crystals__span">
<p id="qf_review__aesthetics__crystals__prompt">5/10</p>
<div>
<input title="Crystals" value="5" type="hidden" name="crystals" id="qf_review__aesthetics__crystals" class="qf-hidden-input qf-slider qf-input"/>
</div>
<div class="qf-slider-bar" id="qf_review__aesthetics__crystals__slider"> </div>
</span>
</div>
<div>
<div class="clear"> </div>
</div>-->
<div class="qf-select-wrapper" id="qf_review__aesthetics__color__wrapper">
<span class="qf-label-span" id="qf_review__aesthetics__color__label_span">
<label id="qf_review__aesthetics__color__label" for="qf_review__aesthetics__color">Color</label>
<p style="font-size: 9pt; color: #666; margin: 0 0 2px">What color(s) stand out in this bud?</p>
</span>
<span class="qf-select-span" id="qf_review__aesthetics__color__span">
<span class="qf-select-inner" id="qf_review__aesthetics__color__inner">
<div class="qf-select review-selector" id="qf_review__aesthetics__color">
<?php foreach($colours as $colour)
{?> <a href="javascript:void(0);" onclick="$(this).addClass('sel')" title="<?php echo $colour['Colour']['id'];?>" class="btn btn-info qf_review__aesthetics__color"><?php echo ucfirst($colour['Colour']['title']);?></a>
<?php }
?>
</div>
<!--
<select title="Color" class="qf-select review-selector" name="review__aesthetics__color" id="qf_review__aesthetics__color">
<option value="" class="qf-option">Select one or more colors to rate</option>
<?php foreach($colours as $colour)
{?>
    <option value="<?php echo $colour['Colour']['id'];?>" class="qf-option"><?php echo $colour['Colour']['title'];?></option>
<?php }?>
</select>-->
</span>
</span>
</div>
<div>
<div class="clear"> </div>
</div>
<div class="qf-select-wrapper" id="qf_review__aesthetics__flavor__wrapper">
<span class="qf-label-span" id="qf_review__aesthetics__flavor__label_span">
<label id="qf_review__aesthetics__flavor__label" for="qf_review__aesthetics__flavor">Flavor / Scent</label>
<p style="font-size: 9pt; color: #666; margin: 0 0 2px">How does this strain taste & smell?</p>
</span>
<span class="qf-select-span" id="qf_review__aesthetics__flavor__span">
<span class="qf-select-inner" id="qf_review__aesthetics__flavor__inner">
<div class="qf-select review-selector" id="qf_review__aesthetics__flavor">
<?php foreach($flavors as $flavor)
{?> <a href="javascript:void(0);" onclick="$(this).addClass('sel')" title="<?php echo $flavor['Flavor']['id'];?>" class="btn btn-info qf_review__aesthetics__flavor"><?php echo ucfirst($flavor['Flavor']['title']);?></a>
<?php }
?>
</div>
<!--
<select title="Flavor / Scent" class="qf-select review-selector" name="review__aesthetics__flavor" id="qf_review__aesthetics__flavor">
<option value="" class="qf-option">Select one or more flavors to rate</option>
<?php foreach($flavors as $flavor)
{?>
    <option value="<?php echo $flavor['Flavor']['id'];?>" class="qf-option"><?php echo $flavor['Flavor']['title'];?></option>
<?php }?>
</select>-->
</span>
</span>
</div>
</fieldset>
<fieldset id="qf_review__other" class="qf-fieldset">
<legend>Comments, etc.</legend>
<div class="qf-input-wrapper qf-slider-input-wrapper" id="qf_review__other__overall__wrapper">
<span class="qf-label-span" id="qf_review__other__overall__label_span">
<label id="qf_review__other__overall__label" for="qf_review__other__overall">Overall Rating</label>
</span>
<span class="qf-input-span qf-slider-input-span" id="qf_review__other__overall__span">
<p id="qf_review__other__overall__prompt">1/10</p>
<div>
<input title="Overall Rating" value="1" type="hidden" name="rate" id="qf_review__other__overall" class="qf-hidden-input qf-slider qf-input"/>
</div>
<div class="qf-slider-bar" id="qf_review__other__overall__slider"> </div>
</span>
</div>
<div class="qf-textarea-wrapper" id="qf_review__other__comments__wrapper">
<span class="qf-label-span" id="qf_review__other__comments__label_span">
<label id="qf_review__other__comments__label" for="qf_review__other__comments">Comments*</label>
<p style="font-size: 9pt; color: #666; margin: 0 0 2px">Got something else to say? Speak up!</p>
</span>
<textarea title="Comments" rows="8" maxlength="4000" name="review" id="qf_review__other__comments" class="qf-maxlength-4000 qf-required qf-textarea" required="required"></textarea>
</div>
</fieldset>
<div class="submit">
<input type="submit" name="submit" value="Save My Review" class="button"/>
</div>
</form>
<script>
$(function(){
                /*$('#qf_review__aesthetics__color').change(function() {
					addSlider($(this), 'color');
				});
				$('#qf_review__aesthetics__flavor').change(function() {
					addSlider($(this), 'flavor');
				});
                	
                $('#qf_review__effects__medical').change(function() {
					addSlider($(this), 'medical');
				});
				$('#qf_review__effects__positive').change(function() {
					addSlider($(this), 'positive');
				});
				$('#qf_review__effects__negative').change(function() {
					addSlider($(this), 'negative');
				});*/
                
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
					//var sel = jQ.val();
                    var sel = jQ.attr('title');
					if (sel <= 0) return false;
					var opt = jQ.find('option:selected');
					//var txt = opt.text();
                    var txt = jQ.text();
					var id = type+sel;
					
					if ($('#'+id).length != 0) {
						opt.removeClass("selected");
						$('#'+id).remove();
					} else {
						opt.addClass("selected");
						var cat = (type == 'color' || type == 'flavor') ? 'aesthetics' : 'effects';
						var innerId = '#qf_review__'+cat+'__'+type+'__inner';
                        if(type == 'positive' || type == 'negative')
                            type = 'effect';
						$(innerId).append('<div id="'+id+'" class="review-slider"><label>'+txt+'</label><input type="hidden" id="'+id+'i" name="'+type+'['+sel+']" value="0" /><div class="slider" id="'+id+'s"></div><p id="'+id+'p">0/10</p><div class="clear"> </div></div>');
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
				$("#qf_review__other__overall__slider").slider({'min':1,'max':10,'step':1,'value':1,'slide':function(e,ui){ $('#qf_review__other__overall').val(ui.value);$('#qf_review__other__overall__prompt').html(''+ui.value+'/10'); },'range':'min'});			
				// strain Autocomplete Script
					
    
});
</script>