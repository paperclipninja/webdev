<html>
<head>
	<title>Counter Lab</title>
</head>
<body>
	<h1>Counter Lab</h1>

	<form name="form" method=get action='phpPermute.php'>
	</form>
	<?php
	$datei=fopen("countlog.txt","r");
	$count=fgets($datei,100);
	$lastDate=fgets($datei,100);
	$count=$count+1;
	echo "Total Views: ".$count."<br>";
	echo "Last Time Visited: ".$lastDate."<br>";
	$currentTime=date("g:i a");
	echo "Current Time: ".$currentTime."<br>";

	$datei=fopen("countlog.txt","w");
	fwrite($datei, $count."\n");
	fwrite($datei, $currentTime);
	/*session_start();
	$currentTime=date("g:i a");
	echo "Current Time: ".$currentTime."<br>";
	if(isset($_SESSION['views'])){
		$_SESSION['views']++;
	}
	else{
		$_SESSION['views']=0;
	}
	if(isset($_SESSION['lastTime'])){
		echo "Last Time Visited: ".$_SESSION['lastTime']."<br>";
		$_SESSION['lastTime']=$currentTime;
	}
	else{
		$_SESSION['lastTime']=$currentTime;
		echo "Last Time Visited: ".$_SESSION['lastTime']."<br>";
	}
	echo "Total Views: ".$_SESSION['views']."<br>";*/
	//send hamilton a note to get page run every day or so
	//second page for getting info out of database
	?>
</body>
</html>
