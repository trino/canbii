<script src="<?php echo $this->webroot;?>js/raty.js"></script>
<script src="<?php echo $this->webroot;?>js/labs.js"></script>
<link href="<?php echo $this->webroot;?>css/raty.css" rel="stylesheet" type="text/css" />

<?php
if(isset($_GET['effects'])&&$_GET['effects'])
{
    foreach($_GET['effects'] as $ef)
    {
        $effects[] = $ef;
    }
}
else
$effects = array();

if(isset($_GET['symptoms'])&&$_GET['symptoms'])
{
    foreach($_GET['symptoms'] as $ef)
    {
        $symptoms[] = $ef;
    }
}
else
$symptoms = array();
?>
<script>
    var recent_flag = 'ASC';
    var rated_flag = 'ASC';
    var alpha_flag = 'DESC';
    var viewed_flag = 'ASC';
    var reviewed_flag = 'ASC';
</script>
<div id="portfolio" class="container">
    <h1 class="title" style="margin-bottom: 30px;">Strains</h1>
    <p style="margin-bottom: 30px;">&nbsp;</p>
    <div  class="sort right">
        <strong>SORT:</strong>  &nbsp; &nbsp; <a href="javascript:void(0);" class="eff1" id="recent">Most Recent</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" class="eff1" id="rated">Top Rated</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" class="eff1" id="viewed">Most Viewed</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" class="eff1" id="reviewed">Most Reviewed</a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="javascript:void(0)" class="eff1" id="alpha">Alphabetically</a>
    </div>
    <div class="clear"></div>
    <div>
    <div class="right listing">
    <?php
    if($strain)
    {
        $j=0;
        foreach($strain as $s)
        {
            $j++;
            ?>
            <div class="list">
			<div class="box"> 
            <div class="others"><strong><em><?php echo $s['Strain']['published_date'];?></em></strong></div>
            <a class="lista" href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>"><div class="iconstrain">
                <h2><?php echo $s['StrainType']['title'];?></h2>
                <strong>
                <?php 
                $name_arr = explode(' ',$s['Strain']['name']);
                $i=0;
                foreach($name_arr as $na)
                {
                    $i++;
                    if($i==1){
                        echo ucfirst($na[0]);
                        }
                        else echo strtolower($na[0]);
                        }
                        ?></strong>
                <br />
                <?php echo $s['Strain']['name'];?>
                </div>
                </a>
				<p><?php echo substr($s['Strain']['description'],0,130).'...';?></p>
                <div class="clear"></div>
                <div class="others">
				<a href="<?php echo $this->webroot?>strains/<?php echo $s['Strain']['slug'];?>" class="button-small">View Detail</a>
                <div class="rating<?php echo $j;?> right" style="margin: 0 10px;"></div>
                <div class="left"><em><strong><?php if($s['Strain']['review'])echo $s['Strain']['review'];else echo 0;?> Reviews</strong></em></div>
                <div class="clear"></div>
                <script>
                $(function(){    
                    $('.rating<?php echo $j;?>').raty({number:10,readOnly:true,score:<?php echo $s['Strain']['rating'];?>});
                });
                </script> 
                </div>
                
                </div>
		  </div>
            <?php
        }
    }
    ?>
    <div class="clear"></div>
	</div>
    <div class="left filter">
        <strong style="text-align: center;" class="block">FILTER STRAINS</strong>
        <p>&nbsp;</p>
        <a href="javascript:void(0);" class="block-btn2">FILTER BY EFFECTS</a>
                <div class="choose_eff" >
                <?php $effect = $this->requestAction('/pages/getEff');
                foreach($effect as $e)
                {
                    ?>
                    <a href="javascript:void(0)" class="small-btn eff2" id="eff_<?php echo $e['Effect']['id'];?>"><?php echo $e['Effect']['title']?></a>
                    <?php
                }
                ?>
                <p style="display: none;" class="effe"></p>
                </div>
                
                <a href="javascript:void(0);" class="block-btn2">FILTER BY SYMPTOM</a>
                <div class="choose_sym">
                <?php $effect = $this->requestAction('/pages/getSym');
                foreach($effect as $e)
                {
                    ?>
                    <a href="javascript:void(0)" class="sym2 small-btn" id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
                    <?php
                }
                ?>
                <p style="display: none;" class="symp"></p>
                </div>
    </div>
    <div class="clear"></div>	
    </div>
		
	</div>
    <div id="spinner">
        Loading...
    </div>
    <input type="hidden" class="recent" value="ASC" />
    <input type="hidden" class="rated" value="ASC" />
    <input type="hidden" class="viewed" value="ASC" />
    <input type="hidden" class="reviewed" value="ASC" />
    <input type="hidden" class="alpha" value="DESC" />
    <script>
    var spinnerVisible = false;
    
    $(function(){
     
     
    $('.sym2').click(function(){
        
        
        
        var sort =0;
if($(this).attr('class').replace('searchact','')==$(this).attr('class'))
{
        
    $(this).addClass('searchact');
    $('.effe').append('<input type="hidden" name="symptoms[]" value="'+$(this).attr('id').replace('sym_','')+'" class="symps '+$(this).attr('id')+'"  />')}else{$(this).removeClass('searchact')
   
        $('.'+$(this).attr('id')).remove();
    }
    $('.key').val('');
    /*else
    var sort = 1;*/
    if (!spinnerVisible) {
        $("div#spinner").fadeIn("fast");
        spinnerVisible = true;
    }
        var i=0;
        var val = '';
       $('.effs').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'effects[]='+$(this).val();
        else
            val = val+'&effects[]='+$(this).val();
            }
                
       });
       $('.symps').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'symptoms[]='+$(this).val();
        else
            val = val+'&symptoms[]='+$(this).val();  
            }       
    });
    if(val){
        val = val+'&key=';
        }
        else
        val = 'key=';
        
         
        
        $.ajax({
           url:'filter',
           data:val,
           type:'get',
           success:function(res){
             if (spinnerVisible) {
        var spinner = $("div#spinner");
        spinner.stop();
        spinner.fadeOut("fast");
        spinnerVisible = false;
    }
            $('.listing').html(res);
           } 
        });
        
    }); 
     
     
     
        
    $('.eff2').click(function(){
        
        
        
        var sort =0;
if($(this).attr('class').replace('searchact','')==$(this).attr('class'))
{
        
    $(this).addClass('searchact');
    $('.effe').append('<input type="hidden" name="effects[]" value="'+$(this).attr('id').replace('eff_','')+'" class="effs '+$(this).attr('id')+'"  />')}else{$(this).removeClass('searchact')
   
        $('.'+$(this).attr('id')).remove();
    }
    $('.key').val('');
    /*else
    var sort = 1;*/
    if (!spinnerVisible) {
        $("div#spinner").fadeIn("fast");
        spinnerVisible = true;
    }
        var i=0;
        var val = '';
       $('.effs').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'effects[]='+$(this).val();
        else
            val = val+'&effects[]='+$(this).val();
            }
                
       });
       $('.symps').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'symptoms[]='+$(this).val();
        else
            val = val+'&symptoms[]='+$(this).val();  
            }       
    });
    if(val){
        val = val+'&key=';
        }
        else
        val = 'key=';
        
         
        
        $.ajax({
           url:'filter',
           data:val,
           type:'get',
           success:function(res){
             if (spinnerVisible) {
        var spinner = $("div#spinner");
        spinner.stop();
        spinner.fadeOut("fast");
        spinnerVisible = false;
    }
            $('.listing').html(res);
           } 
        });
        
    });
    
    $('.eff1').click(function(){
        var id = $(this).attr('id');
        var sort = $('.'+id).val();
        if(sort == 'ASC')
        {
            sort = 'DESC';
            $('.'+id).val('DESC');
        }
        else
        {
            sort = 'ASC';
            $('.'+id).val('ASC');
        }
        
        

        
    
    
    if (!spinnerVisible) {
        $("div#spinner").fadeIn("fast");
        spinnerVisible = true;
    }
        var i=0;
        var val = '';
       $('.effs').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'effects[]='+$(this).val();
        else
            val = val+'&effects[]='+$(this).val();
            }
                
       });
       $('.symps').each(function(){
        if($(this).val()){
        i++;
        if(i==1)
            val = 'symptoms[]='+$(this).val();
        else
            val = val+'&symptoms[]='+$(this).val();  
            }       
    });
    if(val){
        val = val+'&key=';
        }
        else
        val = 'key=';
        if(sort)
        {
            val = val+'&sort='+id+'&order='+sort;
        }
        
         
        
        $.ajax({
           url:'filter',
           data:val,
           type:'get',
           success:function(res){
             if (spinnerVisible) {
        var spinner = $("div#spinner");
        spinner.stop();
        spinner.fadeOut("fast");
        spinnerVisible = false;
    }
            $('.listing').html(res);
           } 
        });
        
    });    
    <?php
    if($effects)
    {
        foreach($effects as $eff)
        {
            ?>
            $('#eff_<?php echo $eff;?>').click();
            <?php
        }
    }
    if($symptoms)
    {
        foreach($symptoms as $eff)
        {
            ?>
            $('#sym_<?php echo $eff;?>').click();
            <?php
        }
    }
    ?>
    });
    
    </script>
    
    