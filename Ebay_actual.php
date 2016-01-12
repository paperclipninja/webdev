
<html>
<head>
	<title>DATABASE</title>
</head>
<body onload=load()>
	<h1> THE DATABASE</h1>
	<form name='myform' method=get action='datab.php'>
Enter Username: <input type="text" name="str" id="str"value="">
<button type=submit name="button" accessKey='s'><u>S</u>ubmit</button>
</form>

<?php
//$database= fopen( "database.txt","w");
error_reporting(E_ALL); 
$queery=$_REQUEST["str"];


 

//shipping price and rating and when auction expires
//then dump to a file
//CREATE TABLE tablename(id PRIMARY KEY int, AuctionId UNIQUE INT, Price INT, Shipping INT, Rtg INT, Condition TEXT, Title TEXT)
//INSERT INTO ebay (id, auctionid, price, shippiung, rtg, conditoin, title)VALUES(null, 12321321321, 33,3,3,'some trext', 'title')
//$result=$db->query('SELECT * FROM items') or die ('Query failed');
?>

</body>
</html>
