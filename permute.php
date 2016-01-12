    <?php
    $prefix="";
$str="abcd";

$array=array();

function permute($prefix, $str, $array)
{
	$n = strlen($str);
	if($n==0)
	{
		$array[$prefix]=1;
		
	}
	else{
		for($i=0; $i<$n; $i++)
		{
		permute($prefix.$str[$i], substr($str,0,$i).substr($str, $i+1,$n),$array);
		}
	}

}
permute($prefix,$str,$array);
echo array_keys($array);
    ?>