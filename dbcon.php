<?php  
class clsConnet{
    public static function DBConnect(){
		
        $connect=mysqli_connect("localhost", "qlkytucxa", "abcd@113");
        mysqli_select_db($connect,"qlkytucxa");
        mysqli_query($connect,"SET NAMES 'utf8'");
        return $connect;
		/*
		$connect=mysql_connect("localhost", "quanlyktx", "ctecsystem");
        mysql_select_db("quanlyktx", $connect);
        mysql_query("SET NAMES 'utf8'",$connect);
        return $connect;*/
    }
	//public static function DBConnect1(){
        	//$connect=mysql_connect("localhost", "qldtuser", "ctecsystem");
        	//mysql_select_db("quanlydaotao_back", $connect1);
        	//mysql_query("SET NAMES 'utf8'",$connect1);
        	//return $connect1;
    	//}
}

//    $link = mysql_connect ("localhost", "root", "")
//        or die ("Could not connect to MySQL Database");      
//    mysql_select_db("ktxdatabase", $link);  
//    mysql_query("SET CHARACTER SET utf8",$link);
?>

