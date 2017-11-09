<?php

$lines = file('http://localhost/index.php');
$lines = implode($lines);
$lines = strip_tags($lines);

preg_match_all("~/[\da-z]{1,7}[\d]{2}:[\d]{2}~", $lines, $Info);

$Info = call_user_func_array('array_merge', $Info);

$Sources = $Info;
$Info = implode($Info);


foreach ($Sources as &$val){
	$val = substr($val, 0, -5);
	$val = substr($val, 1);
}

unset($val);

preg_match_all("~[\d]{2}:[\d]{2}~", $Info, $Uptimes);
$Uptimes = call_user_func_array('array_merge', $Uptimes);


$keys = array_keys($Uptimes, '00:00');


$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

foreach ($keys as $val) {

	$queryName = "SELECT ID FROM views WHERE ID LIKE '%".$Sources[$val]."%'";
	$result = mysqli_query($link, $queryName) or die("Ошибка " . mysqli_error($link)); 
	$rows = mysqli_num_rows($result);

	if ($rows > 0) {
		$ID_NAME = mysqli_fetch_row($result);
		$queryplus = "UPDATE views SET TOTAL=TOTAL+1 WHERE ID LIKE '%".$ID_NAME[0]."%'";
		mysqli_query($link, $queryplus) or die("Ошибка " . mysqli_error($link)); 
		$querytotal = "UPDATE views SET TODAY=TODAY+1 WHERE ID LIKE '%".$ID_NAME[0]."%'";
		mysqli_query($link, $querytotal) or die("Ошибка " . mysqli_error($link)); 
		unset($ID_NAME);
	}
	else
	{
		$query = "INSERT INTO views (ID) VALUES('$Sources[$val]')";
		mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	}
}
	
foreach ($Sources as $value){

	$queryName = "SELECT ID FROM uptimes WHERE ID LIKE '%".$value."%'";
	$result = mysqli_query($link, $queryName) or die("Ошибка " . mysqli_error($link)); 
	$rows = mysqli_num_rows($result);

	if ($rows > 0) {
		$ID_NAME = mysqli_fetch_row($result);
		$queryplus = "UPDATE uptimes SET TOTAL=ADDDATE(TOTAL, INTERVAL '00:01' HOUR_MINUTE) WHERE ID LIKE '%".$ID_NAME[0]."%'";
		mysqli_query($link, $queryplus) or die("Ошибка " . mysqli_error($link)); 
		$querytotal = "UPDATE uptimes SET TODAY=ADDDATE(TODAY, INTERVAL '00:01' HOUR_MINUTE) WHERE ID LIKE '%".$ID_NAME[0]."%'";
		mysqli_query($link, $querytotal) or die("Ошибка " . mysqli_error($link)); 
		unset($ID_NAME);
	}
	else
	{
		$query = "INSERT INTO uptimes (ID) VALUES('$value')";
		mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	}
}

if( date("H:i") == "00:00" ) // написал сравнение с 00:00, ибо подумал, что 00:00:00 может не словиться проверка, отличие в минуту, надеюсь, не критично
{
	$queryID = "SELECT ID FROM views";
	$resultID = mysqli_query($link, $queryID) or die("Ошибка " . mysqli_error($link)); 
	$rowsID = mysqli_num_rows($resultID);

	for ($i = 0 ; $i < $rowsID ; $i++)
	{
		$ID_VIEWS = mysqli_fetch_row($resultID);
		$queryYester = "UPDATE views SET YESTERDAY=TODAY WHERE ID LIKE '%".$ID_VIEWS[0]."%'";
		mysqli_query($link, $queryYester) or die("Ошибка " . mysqli_error($link)); 
		$queryNull = "UPDATE views SET TODAY=0 WHERE ID LIKE '%".$ID_VIEWS[0]."%'";
		mysqli_query($link, $queryNull) or die("Ошибка " . mysqli_error($link)); 
	}

	$queryIDup = "SELECT ID FROM uptimes";
	$resultIDup = mysqli_query($link, $queryIDup) or die("Ошибка " . mysqli_error($link)); 
	$rowsIDup = mysqli_num_rows($resultIDup);

	for ($i = 0 ; $i < $rowsIDup ; $i++)
	{
		$ID_UPTIMES = mysqli_fetch_row($resultIDup);
		$queryYesterup = "UPDATE uptimes SET YESTERDAY=TODAY WHERE ID LIKE '%".$ID_UPTIMES[0]."%'";
		mysqli_query($link, $queryYesterup) or die("Ошибка " . mysqli_error($link)); 
		$queryNullup = "UPDATE uptimes SET TODAY=0 WHERE ID LIKE '%".$ID_UPTIMES[0]."%'";
		mysqli_query($link, $queryNullup) or die("Ошибка " . mysqli_error($link)); 
	}
}
mysqli_close($link);

?>
