<div id="header" class="start-header">
  <div id="title">
    <header>New Cannabis Review</header>
    <div class="review-intro">
      Write a review for each new cannabis strain, edible or topical you try. We'll log it in your journal and you can choose to keep your entry private or make it public for the benefit of other Leafly patients. 
    </div>
  </div>
</div>
<div id="create" class="start" >

  <!-- Main -->
  <form action="" method="post">
  <div id="part-main" class="form-part">
    <div>
      <label for="searchName">1. Enter Name:</label>
      <input type="text" id="searchName" value="" />
			<span class="extra">(e.g., Blue Dream, Dixie Elixir Pomegranate, Ettalew's Edibles)</span>
    </div>
  </div>
  <div class="results" style="display: none;">
    <label >2. Select Item to Review:</label><br />
    <input type="hidden" name="strain" value="" id="strainz" />
    <div class="butt"></div>
  </div>
  <div class="submit">
  <input type="submit" name="submit" id="sub" value="Start Review" disabled="disabled" />
  </div>
  </form>
</div>  
  <script>
  $(function(){
    $('.opt').live('click',function(){
        $("#strainz").val($(this).attr("title"));
       $("#sub").removeAttr("disabled"); 
      if($(this).attr('class').replace('sel',"")!=$(this).attr('class'))
        {
            $(this).removeClass('sel');
            return
        }
        $('.opt').each(function(){
            $(this).removeClass('sel');
        });
        $(this).addClass('sel');
    })
    $('#searchName').keyup(function(){
        var txt = $(this).val();
        $.ajax({
            type:"post",
            url:"<?php echo $this->webroot;?>strains/ajax_search",
            data:"str="+txt,
            success: function(msg)
            {
                $('.results').show();
                $('.butt').html(msg);
            }
        }) 
    });
  });
  </script>