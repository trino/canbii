<div class="tabs">
    <a href="<?php echo $this->webroot;?>users/settings" class="button">Settings</a>
    <a href="<?php echo $this->webroot;?>review" class="button">Add Review</a>
    <a href="<?php echo $this->webroot;?>review/all" class="button">My Reviews</a>
</div>
<div>

<table>
<thead><th>Strain</th><th>Date</th><th>Comment</th><th>Overall Rating</th><th></th></thead>
<?php 
//var_dump($reviews);
foreach($reviews as $review)
{?>
   <tr> 
        <td><?php echo $review['Strain']['name'];?></td>
        <td><?php echo $review['Review']['on_date'];?></td>
        <td><?php echo $review['Review']['review'];?></td>
        <td><?php echo $review['Review']['rate'];?></td>
        <td><a href="<?php echo $this->webroot;?>review/detail/<?php echo $review['Review']['id'];?>">View Detail</a></td>
   </tr> 
<?php }?>
</table>
</div>