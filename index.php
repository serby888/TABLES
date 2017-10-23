<!DOCTYPE html>
<html>
<head>
	<title>Tables</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
</head>
<body>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    <script>

    $(document).ready(function(){
        $('#mytable').DataTable();
    });

    </script>

<?php 


echo '
    <table id="mytable" class="table table-hover table-bordered table-row text-center">
        <thead>
                <tr>
                    <th>IP</th>
                    <th>Source</th>
                    <th>Uptime</th>
                </tr>
            </thead> 
            <tbody> 
    ';

 $url = "url2.html"; // сюда нужно вставить путь  к файлу
 $url2 = "url1.html"; // сюда нужно вставить путь  к файлу
 $url3 = "url3.html"; // сюда нужно вставить путь  к файлу

InfoTable($url);
InfoTable($url2);
InfoTable($url3);


echo '</tbody>';         
echo '</table>';



function InfoTable($url)
{
        if(!($fp = fopen($url, "r")))
        echo "Невозможно открыть файл.";
        else
        {
            $contents = fread($fp, filesize($url));
            fclose($fp);
            $contents = strip_tags($contents);
           // echo $contents;
            preg_match_all("~[\d]{3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}/[\da-z]{1,7}[\d]{2}:[\d]{2}~", $contents, $Info, PREG_SET_ORDER);
           // preg_match_all("~/[0-9a-z]{1,7}~", $contents, $Source, PREG_SET_ORDER);
          //  preg_match_all("/[0-9]{2}:[0-9]{2}/", $contents, $Uptime, PREG_SET_ORDER);


            foreach ($Info as $val) {

            $IP = explode('/', $val[0]);
            $Source = substr($IP[1], 0, -5);
            $Uptime = substr($IP[1], -5);

            echo "<tr><td>".$IP[0]."</td><td>/".$Source."</td><td>".$Uptime."</td></tr>";

            }
        }
}


?>



</body>
</html>