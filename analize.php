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

echo "start<br>";
$query1="SELECT * FROM events WHERE result='no' LIMIT 0,1 ";
$rez1=mysqli_query($db,$query1);
echo $query1."<br>";
while($row1=mysqli_fetch_assoc($rez1)) 
   {
   //
   $event=$row1[id];
   echo $event."<br>";
   // 
   $pos=0; $deltapos=10;
   $search=0;
   // get count
   $query2="SELECT * FROM data WHERE event='".$event."' ";
   $rez2=mysqli_query($db,$query2);  
   $count=mysqli_num_rows($rez2);
   echo "count=".$count."<br>";

   $count0=0; $deltapos=10;
   $search=0;
   
   
   $kz=array(0,0,0,0); 
   while($count0+$deltapos < $count)
      {
      $query3="SELECT * FROM data WHERE event='".$event."' LIMIT ".$count0.",".$deltapos." ";
      //echo $query3."<br>";
      $rez3=mysqli_query($db,$query3);
      $sumoffset5=0;
      $sumoffset6=0;
      $sumoffset7=0;
      $sumoffset8=0;  
      while($row3=mysqli_fetch_assoc($rez3))
         {
          $sumoffset5=$sumoffset5+$row3[p5]*$row3[p5];
          $sumoffset6=$sumoffset6+$row3[p6]*$row3[p6];
          $sumoffset7=$sumoffset7+$row3[p7]*$row3[p7];
          $sumoffset8=$sumoffset8+$row3[p8]*$row3[p8];
          //echo "sumoffset5=".$sumoffset5."<br>";
         }
      if(sqrt($sumoffset5/$deltapos)>15) {$kz[0]++;}   
      if(sqrt($sumoffset6/$deltapos)>15) {$kz[1]++;}   
      if(sqrt($sumoffset7/$deltapos)>15) {$kz[2]++;}   
      if(sqrt($sumoffset8/$deltapos)>15) {$kz[3]++;}   
      //echo "limit ".$count0." - ".($count0+$deltapos)."<br>";
      echo "sumoffset5=".sqrt($sumoffset5/$deltapos)."  sumoffset6=".sqrt($sumoffset6/$deltapos)."  sumoffset7=".sqrt($sumoffset7/$deltapos)."  sumoffset8=".sqrt($sumoffset8/$deltapos)."<br>";
      echo "kz[0]=".$kz[0]."kz[1]=".$kz[1]."kz[2]=".$kz[2]."kz[3]=".$kz[3]."<br>";
      $count0=$count0+$deltapos;   
      }
      $query4="UPDATE events SET
                   A='".(($kz[0]>5)?'X':'+')."',
                   B='".(($kz[1]>5)?'X':'+')."',
                   C='".(($kz[2]>5)?'X':'+')."',
                   result='yes'
               WHERE id='".$event."'  ";
      echo $query4."<br>";
      $rez4=mysqli_query($db,$query4);
      
   }
echo "end";

?>

