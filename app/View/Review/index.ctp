<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<div id="precision" style="cursor: pointer;">
<img class="raty-cancel" title="Cancel this rating!" src="raty/images/cancel-off.png" alt="x"/>
<img alt="1" src="raty/images/star-off.png" title="bad"/>
<img alt="2" src="raty/images/star-off.png" title="poor"/>
<img alt="3" src="raty/images/star-off.png" title="regular"/>
<img alt="4" src="raty/images/star-off.png" title="good"/>
<img alt="5" src="raty/images/star-off.png" title="gorgeous"/>
<input type="hidden" name="score" />
</div>
<div id="precision-hint" class="input hint"></div>
<script>
$(function(){
    

    $('#precision').raty({
      cancel     : true,
      cancelOff  : 'cancel-off.png',
      cancelOn   : 'cancel-on.png',
      path       : '<?php echo $this->webroot;?>raty/images',
      starHalf   : 'star-half.png',
      starOff    : 'star-off.png',
      starOn     : 'star-on.png',
      target     : '#precision-hint',
      targetKeep : true,
      precision  : true,
      number     : 5
    });
});
</script>