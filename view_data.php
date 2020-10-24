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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
  <meta name="robots" content="noindex" />
  <link rel="StyleSheet" type="text/css" href="css/site.css" />
  <title>Россети</title>
  
  <script type="text/javascript">
    function loadCanvas()
     {
        //alert("start");
        //var canvas1 = document.getElementById("canvas1"),
			  //     ctx1= canvas1.getContext('2d');
        //ctx1.beginPath();
        //ctx1.moveTo(50,40);
        //ctx1.lineTo(5000,40);
        //ctx1.stroke();     
        //ctx1.beginPath();
        //ctx1.moveTo(50,0);
        //ctx1.lineTo(50,80);
        //ctx1.stroke();     
        <?php
        
        $p=array('','p1','p2','p3','p4','p5','p6','p7','p8');
        $t=array('','Ua','Ud','Uc','3U0','Ia','Id','Ic','3I0');
        for ($j = 1; $j <= 8; $j++) 
           {        
           $k="var canvas".$j." = document.getElementById('canvas".$j."'),ctx".$j."= canvas".$j.".getContext('2d');";
           $k.="ctx".$j.".font = 'italic 16pt Arial';";
           $k.="ctx".$j.".fillText('".$t[$j]."', 5, 50);";
           $k.="ctx".$j.".beginPath();";
           $k.="ctx".$j.".moveTo(50,40);";
           $k.="ctx".$j.".lineTo(5000,40);";
           $k.="ctx".$j.".moveTo(50,0);";
           $k.="ctx".$j.".lineTo(50,80);";
           $k.="ctx".$j.".stroke();";
           echo $k;     
           $query1="SELECT p".$j." FROM data WHERE event='".$_GET[id]."' ORDER BY id ASC LIMIT 0, 2500";
           $rez1=mysqli_query($db,$query1);
           $dpr=0;$dt=0;$i=50; 
           while($row1=mysqli_fetch_assoc($rez1)) 
              {
              $kod="ctx".$j.".beginPath();"; 
              $dt=floor(80-($row1[$p[$j]]+400)/10);
              $kod.="ctx".$j.".moveTo(".$i.",".$dpr.");";
              $kod.="ctx".$j.".lineTo(".($i+2).",".$dt.");";
              $kod.="ctx".$j.".stroke();";
              echo $kod;
              $i=$i+2; 
              $dpr=$dt;
              }
           }
        ?>
        //alert("end");    
    } 
  </script>
 
</head>

<body onload="loadCanvas();">


<div>
  <canvas id="canvas1" width="5000" height="80" 
    style="background-color:#F0E03E">
  </canvas>
  <canvas id="canvas2" width="5000" height="80" 
    style="background-color:#C7AEF2">
  </canvas>
  <canvas id="canvas3" width="5000" height="80" 
    style="background-color:#77E022">
  </canvas>
  <canvas id="canvas4" width="5000" height="80" 
    style="background-color:#FFABAA">
  </canvas>
  <canvas id="canvas5" width="5000" height="80" 
    style="background-color:#F0E03E">
  </canvas>
  <canvas id="canvas6" width="5000" height="80" 
    style="background-color:#C7AEF2">
  </canvas>
  <canvas id="canvas7" width="5000" height="80" 
    style="background-color:#77E022">
  </canvas>
  <canvas id="canvas8" width="5000" height="80" 
    style="background-color:#FFABAA">
  </canvas>
</div>



</body>
</html>