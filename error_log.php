<?php

/**
* The purpose was to create a single page that could fetch and display the error log 
*  @author Kiran Ruth 
* License : Non applicable
*/

// check if error log is enabled
$isLog = ini_get('log_errors');
if($isLog != 1){
	exit;
}
$logFile = ini_get('error_log');
// if trun then truncate the errorLog
if($_REQUEST['req'] == "trun"){
	$myFile = $logFile;
	$fh = fopen($myFile, 'w');
	fclose($fh);	
	header('Location: error_log.php');
}
// refresh errorLog
if($_REQUEST['req'] == "refresh"){
	header('Location: error_log.php');
}

?>
<html>
<title>
Php Error Log Viewer
</title>
<link rel="icon" 
      type="image/png" 
      href="http://www.sql-tutorial.ru/view/gimages/console.png"></link>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>	  
<style>
Body{
	margin-left:10px;
	margin-right:10px;
	display:block;
	margin-top:10px;
	margin-bottom:10px;
	background-color:#efefef;
	border-style: solid;
	border-width: 2px;
	padding: 5px;
	max-height
}

a{
	padding: 4px;
	border-radius: 5px;
	text-decoration: initial;
	margin-top:10px;
	margin-right:6px;
}

a:hover{
	padding-top: 4px;
	border-radius: 5px;
	text-decoration: initial;
	margin-right:6px;
}
.truncate{
	background-color: #FC2A2A;
	color: white;
}

.truncate:hover{
	background-color: #f47a7a;
	color: white;
}

.refresh{
		background-color: #7fff00;
		color: black;
}

.refresh:hover{
		background-color: #d4ffaa;
		color: black;
}

.bar{
	padding: 10px;
	background-color: #666;
	position: fixed;
	top: 0px;
	left: 0px;
	width: 100%;
}

</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#scroll_up').click(function(){
			$('html, body').animate({ scrollTop: 0 });
		});	
		$('#scroll_down').click(function(){
			var target = $('#end').offset().top;
			console.log(target);
			$('html, body').animate({ scrollTop: target });
		});
	});
</script>

<body>
<div class="bar">
<a class="truncate" href="error_log.php?req=trun">Truncate</a>
<a class="refresh" href="error_log.php?req=refresh">Refresh</a>
<a class="refresh" id="scroll_down" href="#">Scroll Down</a>
<a class="refresh" id="scroll_up" href="#">Scroll Up</a>
</div>
<BR/>
<BR/>
<?php

$errorLog =  file_get_contents($logFile);
// echo error log :p .... yeah yeah i know no rocket science just thought i'll comment
echo nl2br($errorLog);
?>
<div id="end"></div>
</body>
</html>