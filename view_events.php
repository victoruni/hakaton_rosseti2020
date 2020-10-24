<?php

//Параметры MySQL
$location="localhost";
$user="bhx20666_parking";
$pass="parking12345678";
$db_name="bhx20666_hakaton_rosseti";

// connect db
if(! $db=mysqli_connect($location,$user,$pass,$db_name))
 {echo "connect error";}
else
 {;}
mysqli_query($db,"SET CHARACTER SET 'utf8'"); 


$content1="<br><b>EVENTS</b><br>";
$content1.="<table border='1' cellpadding='5' style='border-collapse: collapse; border: 1px solid black;'";
$content1.="<tr>";
$content1.="<td>n/n</td>";
$content1.="<td>Object</td>";
$content1.="<td></td>";
$content1.="<td>time1</td>";
$content1.="<td>timestart</td>";
$content1.="<td>A</td>";
$content1.="<td>B</td>";
$content1.="<td>C</td>";
$content1.="<td>duration, sec </td>";
$content1.="<td>chart</a></td>";
$content1.="</tr>";
$query1="SELECT * FROM events  ";
$rez1=mysqli_query($db,$query1);  $i=1;
while($row1=mysqli_fetch_assoc($rez1)) {
   $content1.="<tr>";
   $content1.="<td>".$i."</td>";
   $content1.="<td>".$row1['object']."</td>";
   $content1.="<td>".$row1['channels']."</td>";
   $content1.="<td>".$row1['time1']."</td>";
   $content1.="<td>".$row1['timestart']."</td>";
   $content1.="<td>".$row1['A']."</td>";
   $content1.="<td>".$row1['B']."</td>";
   $content1.="<td>".$row1['C']."</td>";
   $content1.="<td>".$row1['duration']."</td>";
   $content1.="<td><a href='view_data.php?id=".$row1['id']."'>".str_replace(".cfg","",$row1['file'])."</a></td>";
   $content1.="</tr>";
   $i++;
   }
$content1.="</table>";
echo $content1;

?>

