<?php
$db = new SQLite3('database') or die('Unable to open database');
$query = <<<EOD
CREATE TABLE IF NOT EXISTS items (itemId STRING PRIMARY KEY, name STRING, price STRING,shipping STRING,endDate STRING,condition STRING, currentDate STRING)
EOD;
$db->exec($query) or die('Create databse failed');
$result=$db->query('SELECT*FROM items') or die('Query Failed');
$str="<table><tr><td>Item Id</td><td>Name</td><td>Price</td><td>Shipping Cost</td><td>Auction End Date</td><td>Condition</td><td>Date Accessed</td></tr>";

while($row=$result->fetchArray())
{
	$str=$str."<tr><td>{$row['itemId']}</td><td>{$row['name']}</td><td>{$row['price']}</td><td>{$row['shipping']}</td><td>{$row['endDate']}</td><td>{$row['condition']}
	</td><td>{$row['currentDate']}</td></tr>";
}
$str-$str."</table>";
echo $str;
?>