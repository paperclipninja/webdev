<?
$db = new SQLite3('my_database') or die('Unable to open database');
$query = <<<EOD
  CREATE TABLE IF NOT EXISTS users (username STRING PRIMARY KEY,
    password STRING)
EOD;
$db->exec($query) or die('Create db failed');
//$user = "Dinosaur";
//$pass = "Potato";
//$query = <<<EOD
 // INSERT INTO users VALUES ( '$user', '$pass' )
//EOD;
//$db->exec($query) or die("Unable to add user $user");
$result = $db->query('SELECT * FROM users') or die('Query failed');
$table="<table><tr><td>User</td><td>Password</td></tr>";
while ($row = $result->fetchArray())
{
  $table=$table."<tr><td>{$row['username']}</td><td>Passwd: {$row['password']}</td>";
}
$table=$table."</table>";
echo $table;
?>