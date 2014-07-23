<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<div id="precision" style="cursor: pointer;" >

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