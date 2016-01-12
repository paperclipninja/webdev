
<html>
<head>
	<title>Ebay</title>
</head>
<body onload=load()>
	<h1> Ebay Lab</h1>
	<form name='myform' method=get action='Ebay_actual2.php'>
Enter Search item: <input type="text" name="str" id="str"value="">
<button type=submit name="button" accessKey='s'><u>S</u>ubmit</button>
</form>

<?php
$db = new SQLite3('database') or die('Unable to open database');
$query = <<<EOD
CREATE TABLE IF NOT EXISTS items (itemId STRING PRIMARY KEY, name STRING, price STRING,shipping STRING,endDate STRING,condition STRING, currentDate STRING)
EOD;
$db->exec($query) or die('Create databse failed');
//$database= fopen( "database.txt","w");
error_reporting(E_ALL); 
$queery=$_REQUEST["str"];
//number of bids
$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$version = '1.0.0';  // API version supported by your application
$appid = 'NA21f0dd8-fdf7-4f0e-8701-1c87f57943e';  // Replace with your own AppID
$globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
$safequery = urlencode($queery);  // Make the query URL-friendly
$i = '0';  // Initialize the item filter index to 0

// Create a PHP array of the item filters you want to use in your request
$filterarray =
  array(
    array(
    'name' => 'MaxPrice',
    'value' => '350',
    'paramName' => 'Currency',
    'paramValue' => 'USD'),
    array(
    'name' => 'FreeShippingOnly',
    'value' => 'false',
    'paramName' => '',
    'paramValue' => ''),
    array(
    'name' => 'ListingType',
    'value' => array('AuctionWithBIN','FixedPrice','StoreInventory'),
    'paramName' => '',
    'paramValue' => ''),
  );
  function buildURLArray ($filterarray) {
  global $urlfilter;
  global $i;
  // Iterate through each filter in the array
  foreach($filterarray as $itemfilter) {
    // Iterate through each key in the filter
    foreach ($itemfilter as $key =>$value) {
      if(is_array($value)) {
        foreach($value as $j => $content) { // Index the key for each value
          $urlfilter .= "&itemFilter($i).$key($j)=$content";
        }
      }
      else {
        if($value != "") {
          $urlfilter .= "&itemFilter($i).$key=$value";
        }
      }
    }
    $i++;
  }
  return "$urlfilter";
} // End of buildURLArray function
buildURLArray($filterarray);

// Construct the findItemsByKeywords HTTP GET call 
$apicall = "$endpoint?";
$apicall .= "OPERATION-NAME=findItemsByKeywords";
$apicall .= "&SERVICE-VERSION=$version";
$apicall .= "&SECURITY-APPNAME=$appid";
$apicall .= "&GLOBAL-ID=$globalid";
$apicall .= "&keywords=$safequery";
$apicall .= "&paginationInput.entriesPerPage=25";
$apicall .= "$urlfilter";

// Load the call and capture the document returned by eBay API
$resp = simplexml_load_file($apicall);
$currentDate=date("Y/m/d");
// Check to see if the request was successful, else print an error
if ($resp->ack == "Success") {
  $results = "<table cellpadding='10'>";
  // If the response was loaded, parse it and build links  
  foreach($resp->searchResult->item as $item) {
    $pic   = $item->galleryURL;
    $link  = $item->viewItemURL;
    $title = $item->title;
    $price = $item->sellingStatus->convertedCurrentPrice;
    $shipping = $item->shippingInfo->shippingServiceCost;
    $itemId = $item->itemId;
    $endDate = strtotime($item->listingInfo->endTime);
    $endDate = $item->listingInfo->endTime;
    $condition=$item->condition->conditionDisplayName;
    $query=<<<EOD
    INSERT INTO items VALUES ('$itemId','$title','$price','$shipping','$endDate','$condition','$currentDate')
EOD;
$db->exec($query) or die("Unable to add item $item");

//  fwrite($database, "$title : $itemId , $price, $endDate"."\r\n");
    // For each SearchResultItem node, build a link and append it to $results
    $results .= "<tr>
    <td><img src=\"$pic\"></td>
    <td><a href=\"$link\">$title</a></td>
    <td> $price</td>
    <td>$shipping</td>
    <td>$endDate</td>
    <td>$itemId</td>
    <td>$condition</td>
    </tr> ";
  }
  $results .="<table>";

}
// If the response does not indicate 'Success,' print an error
else {
  $results  = "<h3>Oops! The request was not successful. Try searching for something else.</h3> ";
}
echo $results;
//shipping price and rating and when auction expires
//then dump to a file
//CREATE TABLE tablename(id PRIMARY KEY int, AuctionId UNIQUE INT, Price INT, Shipping INT, Rtg INT, Condition TEXT, Title TEXT)
//INSERT INTO ebay (id, auctionid, price, shippiung, rtg, conditoin, title)VALUES(null, 12321321321, 33,3,3,'some trext', 'title')
//$result=$db->query('SELECT * FROM items') or die ('Query failed');
?>

</body>
</html>
