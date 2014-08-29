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

<div class="page_layout page_margin_top clearfix">
	<div class="page_header clearfix">
		<div class="page_header_left">
			<h1 class="page_title">Filter Strains</h1>
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
					Filter Strains
				</li>
			</ul>
		</div>
		<div class="page_header_right">
			<form class="search">
				<input class="search_input hint" type="text" value="Search by strain name..." placeholder="Search by strain name...">
				
				<input type="submit" value="Search" class="more blue medium " style="height:38px;">
				<input type="submit" value="Reset" class="more dark " style="height:38px;">

			</form>
		</div>
	</div>

	<div class="clearfix page_margin_top ">


<ul class="tabs_navigation2" >
<li>
	<a href="#" class="eff1" id="recent"><strong>SORT:</strong></a> 
	</li><li>
	<a href="javascript:void(0);" class="eff1" id="recent">
	Most Recent</a> 
	</li><li>
	<a href="javascript:void(0)" class="eff1" id="rated">
	Top Rated</a> 
	</li><li>
	<a href="javascript:void(0)" class="eff1" id="viewed">
	Most Viewed</a>  
	</li><li>
	<a href="javascript:void(0)" class="eff1" id="reviewed">
	Most Reviewed</a>  
	</li><li>
	<a href="javascript:void(0)" class="eff1" id="alpha">
	Alphabetically</a>
	</li>
</ul>

	<!-- page left --> 
	
<div class="page_left listing page_margin_top">


<?php include_once('combine/filter.php');?>



</div>
	<!-- end page left --> 

	<!-- page right --> 
	
				<div class="page_right" style="">
				<ul>
				<li class="home_box light_blue animated_element animation-fadeIn duration-500" style="z-index: 3;">
					<h2>
							Filter by Effects
					</h2>
					<div class="news clearfix">

					
				<div class="choose_eff" >
				<?php $effect = $this->requestAction('/pages/getEff');
				foreach($effect as $e)
				{
				?>
									
								
									
				<a style="color:white;" href="javascript:void(0)" class="small-btn eff2" id="eff_<?php echo $e['Effect']['id'];?>"><?php echo $e['Effect']['title']?></a>
				
				<?php
				}
				?>
				<p style="display: none;" class="effe"></p>
				</div>

				</div>
				</li>
				<li class="home_box blue animated_element animation-slideDown duration-800 delay-250" style="z-index: 2;">
				<h2>
				Filter by Symptoms
				</h2>
				<div class="news clearfix">
				<div class="choose_sym">
				<?php $effect = $this->requestAction('/pages/getSym');
				foreach($effect as $e)
				{
				?>
				<a style="color:white;"  href="javascript:void(0)" class="sym2 small-btn" id="sym_<?php echo $e['Symptom']['id'];?>"><?php echo $e['Symptom']['title']?></a>
				<?php
				}
				?>
				<p style="display: none;" class="symp"></p>
				</div>
				</div>
				</li>
				</ul>
				</div>

	<!-- end page right --> 
</div>
</div>

<input type="hidden" class="recent" value="ASC" />
<input type="hidden" class="rated" value="ASC" />
<input type="hidden" class="viewed" value="ASC" />
<input type="hidden" class="reviewed" value="ASC" />
<input type="hidden" class="alpha" value="DESC" />
<div class="clearfix"></div>

<script>
    var more='<?php echo $limit?>';    
    var spinnerVisible = false;
    
    $(function(){
    var sort='';    
    $('.loadmore a').live('click',function(){
        more=parseFloat(more)+4;
        var val = '';
        var i=0;
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
        $('.eff1c').each(function(){
            
        //alert('test');
        var id = $(this).attr('id');
        var sort = $('.'+id).val();
        if(sort == 'DESC')
        {
            sort = 'DESC';
            //$('.'+id).val('DESC');
        }
        else
        {
            sort = 'ASC';
           // $('.'+id).val('ASC');
        }
        val = val+'&sort='+id+'&order='+sort;
        });
        
        $.ajax({
           url:'<?php echo $this->webroot;?>strains/filter/'+more+'<?php if($type)echo '/'.$type?>',
           data:val,
           type:'get',
           success:function(res){
             if (spinnerVisible) {
        var spinner = $("div#spinner");
        spinner.stop();
        spinner.fadeOut("fast");
        spinnerVisible = false;
    }
            $('.morelist').show();
            $('.morelist').addClass('morelist2');
            $('.morelist2').removeClass('morelist');
            $('.morelist2').html(res);
            $('.morelist2').removeClass('morelist2');
           } 
        });
    });
    $('.sym2').click(function(){
        
        //var sort =0;
        more=0;
if($(this).attr('class').replace('searchact2','')==$(this).attr('class'))
{
        
    $(this).addClass('searchact2');
    $('.effe').append('<input type="hidden" name="symptoms[]" value="'+$(this).attr('id').replace('sym_','')+'" class="symps '+$(this).attr('id')+'"  />')}else{$(this).removeClass('searchact2')
   
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
        
        $('.eff1c').each(function(){
            
        alert('test');
        var id = $(this).attr('id');
        var sort = $('.'+id).val();
        if(sort == 'DESC')
        {
            sort = 'DESC';
            //$('.'+id).val('DESC');
        }
        else
        {
            sort = 'ASC';
           // $('.'+id).val('ASC');
        }
        val = val+'&sort='+id+'&order='+sort;
        });
        
        $.ajax({
           url:'<?php echo $this->webroot;?>strains/filter/0<?php if($type)echo '/'.$type?>',
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
        more=0;
        //var sort =0;
if($(this).attr('class').replace('searchact2','')==$(this).attr('class'))
{
        
    $(this).addClass('searchact2');
    $('.effe').append('<input type="hidden" name="effects[]" value="'+$(this).attr('id').replace('eff_','')+'" class="effs '+$(this).attr('id')+'"  />')}else{$(this).removeClass('searchact2')
   
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
        
         
        $('.eff1c').each(function(){
            
        alert('test');
        var id = $(this).attr('id');
        var sort = $('.'+id).val();
        if(sort == 'DESC')
        {
            sort = 'DESC';
            //$('.'+id).val('DESC');
        }
        else
        {
            sort = 'ASC';
           // $('.'+id).val('ASC');
        }
        val = val+'&sort='+id+'&order='+sort;
        });
        $.ajax({
           url:'<?php echo $this->webroot;?>strains/filter<?php if($type)echo '/0/'.$type?>',
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
        more=0;
        $('.eff1').each(function(){
           $(this).removeClass('eff1c'); 
        });
        $(this).addClass('eff1c');
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
           url:'<?php echo $this->webroot;?>strains/filter<?php if($type)echo '/0/'.$type?>',
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