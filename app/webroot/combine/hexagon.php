<div style="margin-right:12px;text-align: center; float:left;width:57px;height:66px;background-repeat: no-repeat;position:relative;">
<img src="<?php echo $this->webroot?>images/<?php 

switch ($strain_hexagon['Strain']['type_id']) {
    case 1:
        echo "Indica";
        break;
    case 2:
        echo "Sativa";
        break;
    case 3:
        echo "Hybrid";
        break;
}

?>.png" style="left: 0;
    position: absolute;
    top: 0;
    z-index: 0;" />
<p class="printer" style="color: #FFF;
    font-size: 20px;
    left: 17px;
    margin-top: 14px;
    position: absolute;
    text-align: center;
    vertical-align: middle;
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
