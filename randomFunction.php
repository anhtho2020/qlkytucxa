<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
</html>
<?php
echo rand() . "\n";
echo "<td>&nbsp</td> ";
echo rand() . "\n";
echo"<br>";
echo "--Lấy 2 1 số ngẫu nhiên trong khoảng 5-> 15 \n";
echo "<td>&nbsp</td> ";
echo rand(5, 15);
echo"<br>";
echo"Mảng ngẩu nhiên: ";
$rd=srand((float) microtime() * 10000000);
echo "Cái gì vậy trời: ".$rd;
echo"<br>";
//-- Tạo 1 mảng có tên $input bao gồm phần tử: "Neo", "Morpheus", "Trinity", "Cypher", "Tank"
$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
//-- Lấy ngẫu nhiên 2 key index trong mảng input đưa vào mảng $rand_keys (Sẽ giải thích key index sau)
$rand_keys = array_rand($input, 2);
//-- Xuất ra phần thử thứ nhất và thứ 2
echo $input[$rand_keys[0]] . "\n";echo"<br>";
echo $input[$rand_keys[1]] . "\n";
?>