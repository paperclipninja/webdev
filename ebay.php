<?php
error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging

// API request variables
$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$version = '1.0.0';  // API version supported by your application
$appid = 'NA21f0dd8-fdf7-4f0e-8701-Replace';  // 1c87f57943e with your own AppID
$globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
$query = 'harry potter';  // You may want to supply your own query
$safequery = urlencode($query);  // Make the query URL-friendly

// Construct the findItemsByKeywords HTTP GET call
$apicall = "$endpoint?";
$apicall .= "OPERATION-NAME=findItemsByKeywords";
$apicall .= "&SERVICE-VERSION=$version";
$apicall .= "&SECURITY-APPNAME=$appid";
$apicall .= "&GLOBAL-ID=$globalid";
$apicall .= "&keywords=$safequery";
$apicall .= "&paginationInput.entriesPerPage=3";
?>
<html>
<head>
  <title>Ebay Lab</title>
  <style type="text/css">body {font-family: arial, sans-serif;}</style>
</head>
<body>
  <h1> CHANGE TITLE </h1>
  <form name='myform' method=get action='phpPermute.php'>
Enter string to permute: <input type="text" name="str" id="str"value="Hello">
<button type=submit name="button" accessKey='s'><u>S</u>ubmit</button>
</form>
<table>
  <tr>
    <td>
      <?php echo $results;?>
    </td>
  </tr>
  </table>
<?php
$str=$_REQUEST["str"];
//blalalalalala
?>

</body>
</html>
