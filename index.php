<?
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tables</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
</head>
<body>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
    <script>

    $(document).ready(function(){
        $('#mytable').DataTable({
            "lengthMenu": [[500, 1000, -1], [500, 1000, "All"]]
        });

        $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    });

    </script>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#table" aria-controls="home" role="tab" data-toggle="tab">Table</a></li>
    <li role="presentation"><a href="#information" aria-controls="profile" role="tab" data-toggle="tab">Information</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="table"><br>

<?php 

require('config.php');
echo '
    <table id="mytable" class="table table-hover table-bordered table-row text-center">
        <thead>
                <tr>
                    <th>IP</th>
                    <th>Source</th>
                    <th>Uptime</th>
                    <th>Package</th>
                </tr>
            </thead> 
            <tbody> ';

InfoTable($urla[1]);
InfoTable($urla[2]);
InfoTable($urla[3]);

echo '</tbody>';         
echo '</table>';



function InfoTable($url)
{
        if(1==0)
        echo "Error opening file";
        else
        {

            $ctx = stream_context_create(array('http'=> array('timeout' => 4,)));
            $contents = file_get_contents($url,false,$ctx);

            $contents = strip_tags($contents);

            preg_match_all("~[\d]{3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}/[\da-z]{1,7}[\d]{2}:[\d]{2}~", $contents, $Info, PREG_SET_ORDER);

            foreach ($Info as $val) {

            $IP = explode('/', $val[0]);
            $Source = substr($IP[1], 0, -5);
            $Uptime = substr($IP[1], -5);

            echo "<tr><td>".$IP[0]."</td><td>/".$Source."</td><td>".$Uptime."</td><td></td></tr>";

            }
        }
}


?>
</div>
    <div role="tabpanel" class="tab-pane fade" id="information">
        <?php

        require('info.php');

        ?>
    </div>

  </div>

</div>


</body>
</html>