<style>
div{border:0px solid green;}
</style>
<?php
switch ($strain_hexagon['Strain']['type_id']) {
case 1:
  $background_hex = $this->webroot . "images/Indica.png";
  break;
case 2:
  $background_hex = $this->webroot . "images/Sativa.png";
  break;
case 3:
  $background_hex = $this->webroot . "images/Indica.png";
  break;
}
?>
<div style="margin-right:12px;text-align: center; float:left;width:57px;height:66px;background-repeat: no-repeat;">
<div style="height:66px;
width:57px;
text-align:center;
display: table-cell;
vertical-align:middle;
background: url('<?=$background_hex?>') no-repeat;">

<p class="printer" style="color: #FFF;
font-size: 20px;
z-index: 100;color:#FFF;">

<?php
$name_arr = explode(' ',$strain_hexagon['Strain']['name']);
$i=0;
foreach($name_arr as $na)
{
$i++;
if($i==1 && $na){
echo ucfirst($na[0]);
}
elseif($na) echo strtolower($na[0]);
}
?>
</p>

</div>
</div>