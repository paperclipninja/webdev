<html>
<head>
	<title>Permutation</title>
</head>
<body>
	<h1> CHANGE TITLE </h1>
	<form name='myform' method=get action='phpPermute.php'>
Enter string to permute: <input type="text" name="str" id="str"value="Hello">
<button type=submit name="button" accessKey='s'><u>S</u>ubmit</button>
</form>

<?php
$str=$_REQUEST["str"];
$array=array();
$prefix="";

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

echo 
?>

</body>
</html>
