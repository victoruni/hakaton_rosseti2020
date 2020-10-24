<?php

     
$filelist = glob("*.cfg");
echo count($filelist)."<br>";

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
 
foreach ($filelist as &$file) {
    echo $file."<br>";
    // поиск в базе
    $query0=" SELECT * FROM events WHERE file='".$file."' ";
    $rez0=mysqli_query($db,$query0);
    echo $query0."<br>";
    if(mysqli_num_rows($rez0)>0)
      {
      echo  $file."  no add<br>";
      }
    else
      {
      echo  $file."  add<br>";  
      // add
      $query1=" INSERT INTO events SET 
          file='".$file."' ";
      mysqli_query($db,$query1);
      $id_event=mysqli_insert_id($db);
      echo  "id_event=".$id_event."<br>";
      // read .cfg
      $fcfg=fopen($file,"r");
      $i=1;$it1=0;$it2=0;
      while (($str = fgets($fcfg, 4096)) !== false)
        {
        echo $i."=".$str."<br>";
        if($i==1)
          {
          list($object, $aa, $aaa) = explode(",", $str);
          echo "object=".$object."<br>";
          }   
        else if($i==2)
          {
          $channels=$str; 
          list($count, $counta, $countd) = explode(",", $str);
          $it1=$i+$count+4; $it2=$it1+1;
          echo "count=".$count."<br>";
          echo "it1=".$it1."<br>";
          echo "it2=".$it2."<br>";
          }   
        else if($i==$it1)
          {
          $time1=str_replace(","," ",$str);
          echo "time1=".$time1."<br>";
          }   
        else if($i==$it2)
          {
          $timestart=str_replace(","," ",$str);
          echo "timestart=".$timestart."<br>";
          }   
        $i=$i+1;
        }
      fclose($fcfg);
      $query2=" UPDATE events SET 
          object='".$object."', channels='".$channels."',
          time1='".$time1."', timestart='".$timestart."' 
          WHERE id='".$id_event."' ";
      mysqli_query($db,$query2);
      echo "query2=".$query2."<br>";
      // ******** add data
      $filedata=str_replace(".cfg",".dat",$file);
      $fdat=fopen($filedata,"r");
      while (($str = fgets($fdat, 4096)) !== false)
        {
        list($number, $time, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8 ) = explode(",", $str);
        $query3=" INSERT INTO data SET 
          event='".$id_event."', number='".$number."', time='".$time."',
          p1='".$p1."', p2='".$p2."',p3='".$p3."',p4='".$p4."',
          p5='".$p5."',p6='".$p6."',p7='".$p7."',p8='".$p8."' ";
        mysqli_query($db,$query3);
        echo "query3=".$query3."<br>";

        }
      fclose($fcfg); 
      // **********
      }
}
 
?>