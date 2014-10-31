<div style="margin-right:12px;text-align: center; float:left;background-image: url('<?php echo $this->webroot?>images/<?php 

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

?>.png');width:57px;height:66px;background-repeat: no-repeat;">
<p style="vertical-align:middle;text-align:center;color:white;font-size:20px; margin-top:14px">
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
