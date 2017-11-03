<?php

$host = 'localhost'; // адрес   сервера 
$database = 'TV'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ""; // пароль

?>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>

    <script>

    $(document).ready(function(){
        $('#mytable2').DataTable({
            "lengthMenu": [[500, 1000, -1], [500, 1000, "All"]]
        });
    });

    </script>
<br>
<?php 


echo '
    <table id="mytable2" width="100%" class="table table-hover table-bordered table-row text-center">
        <thead>
                <tr>
                    <th rowspan="2">Source</th>
                    <th colspan="3">Views</th>
                    <th colspan="3">Uptime</th>
                </tr>
                <tr>
                    <th>Today</th>
                    <th>Yesterday</th>
                    <th>Total</th>

                    <th>Today</th>
                    <th>Yesterday</th>
                    <th>Total</th>
                </tr>
            </thead> 
            <tbody>';

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

$query = "SELECT * FROM Sources";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

$rows = mysqli_num_rows($result);

for ($i = 0 ; $i < $rows ; $i++)
{
  $arr = mysqli_fetch_row($result);
  $ID_Source = $arr[0];

  $queryview = "SELECT  TODAY, YESTERDAY, TOTAL FROM Views WHERE ID_VIEWS LIKE '%".$ID_Source."%'";
  $result2 = mysqli_query($link, $queryview) or die("Ошибка " . mysqli_error($link));
  $array = mysqli_fetch_row($result2);

  $queryuptime = "SELECT  TODAY, YESTERDAY, TOTAL FROM Uptimes WHERE ID_UPTIMES LIKE '%".$ID_Source."%'";
  $result3 = mysqli_query($link, $queryuptime) or die("Ошибка " . mysqli_error($link));
  $array2 = mysqli_fetch_row($result3);

  echo '<tr>';
  echo '<td>'.$arr[1].'</td><td>'.$array[0].'</td><td>'.$array[1].'</td><td>'.$array[2].'</td><td>'.$array2[0].'</td><td>'.$array2[1].'</td><td>'.$array2[2].'</td>';
  echo '</tr>';
}



echo '</tbody>';         
echo '</table>';

?>

