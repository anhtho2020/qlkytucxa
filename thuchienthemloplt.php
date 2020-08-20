<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php
include 'dbcon.php';
    $link=  clsConnet::DBConnect();

        $idbdt=0;
        if(isset($_GET["idbdt"])){
            $idbdt=$_GET["idbdt"];
        }
        
        
        
        $idng=0;
        if(isset($_GET["idng"])){
            $idng=$_GET["idng"];
        }
        $idtr=0;
        if(isset($_GET["idtr"])){
            $idtr=$_GET["idtr"];
        }
        
        $malop='';
        if(isset($_POST["malop"])){
             $malop=$_POST["malop"];
        }
        else echo " ";
        $tenlop='';
        if(isset($_POST["tenlop"])){
             $tenlop=$_POST["tenlop"];
        }
        else echo " ";
 
        if($malop != '' && $tenlop != '')
        {
            $query="insert into loplt(ID_BACHOC,ID_NGANH,ID_TRUONG,MALOPLT,TENLOPLT) "
                    . "values($idbdt,$idng,$idtr,'$malop','$tenlop')";
                    mysqli_query($link,$query);
        }
        header("Location: ktx_nhap_loplt.php");
        ?>
