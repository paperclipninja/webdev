
	var Timer;
	var TotalSeconds;
	function createTimer(TimerID, Time){
		Timer=document.getElementById(TimerID);
		TotalSeconds=Time;
		UpdateTimer();
		window.setTimeout("Tick()",1000);
	}
	    function Tick(){
	    	TotalSeconds-=1;
	    	UpdateTimer()
	    	window.setTimeout("Tick()",1000);
	    }
	    function UpdateTimer(){
	    	document.getElementById("timer").innerHTML=TotalSeconds;

	    }
