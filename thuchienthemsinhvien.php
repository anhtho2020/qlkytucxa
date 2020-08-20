<?php

include 'dbcon.php';
    $link=  clsConnet::DBConnect();

        //mysql_query("SET CHARACTER SET utf8",$link);
        $idlopchuyennganh=$_POST["idlopchuyennganh"];
        $totalRows = 0;       
        $stSQL ="select * from sinhvien where ID_LOPCHUYENNGANH=$idlopchuyennganh";  
        $result = mysql_query($stSQL, $link);  
        $totalRows=mysql_num_rows($result); 
        