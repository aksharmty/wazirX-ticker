<body style="background-color:#000000; color:white;">
  WazirX DOGEINR 1 DAY<br> 
<?php 
include "connect.php";
define('TIMEZONE', 'Asia/kolkata');
date_default_timezone_set(TIMEZONE);
  $date = DATE("Y-m-d H:i:s");
  echo "<br> current date ".$date;
  $time = DATE("H:i");
  echo "<br> current time ".$time;
$curlbidob = curl_init();
curl_setopt($curlbidob, CURLOPT_URL, "https://api.wazirx.com/api/v2/tickers");
curl_setopt($curlbidob, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlbidob, CURLOPT_HEADER, false);
$jsondata0s = curl_exec($curlbidob);
curl_close($curlbidob);
$data = json_decode($jsondata0s, true);
$need = array(  1 =>'DOGE/INR',
    //$market
);
foreach ($data as $key => $value) {//Extract the Array Values by using Foreach Loop
          if (in_array($data[$key]['name'], $need)) {
              $open=$data[$key]['open'];
              $close=$data[$key]['last'];
              $low=$data[$key]['low'];
              $high=$data[$key]['high'];
          }}
echo "<br> Open ".$open;
echo "<br> Close ".$close;
echo "<br> Low ".$low;
echo "<br> High ".$high;

?>
<?php 
echo "<br> current bar ";
$cucan = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM wazir order by id desc limit 1"));
if($cucan['close'] > $cucan['open']){ $colorcu="green";}else{$colorcu="red";}
echo "<font color ='$colorcu'>";
$cuid = $cucan['id']; echo "<br>cu id ". $cuid;
$cuopen = $cucan['open']; echo "<br>cu open ". $cuopen;
$cuclose = $cucan['close']; echo "<br>cu close ". $cuclose;
$cuhigh = $cucan['high']; echo "<br>cu high ". $cuhigh;
$cusig = $cucan['sig']; 
$cuid1 = $cuid-1;
echo "</font>";
if($cusig == "BUY"){ echo "<br><font color=green> SIG ".$sig ."</font>";}else{echo "<br><font color=red>SIG ".$sig ."</font>";}
echo "<br> Last bar";
$lastcan = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM wazir where id ='$cuid1'"));
if($lastcan['open'] < $lastcan['close']){ $colorcu0="green"; $can2 = $lastcan['close'];}else{$colorcu0="red";}
echo "<font color ='$colorcu0'>";
$lastid = $lastcan['id']; echo "<br> id ". $lastid;
$lastclose = $lastcan['close']; echo "<br> close ". $lastclose;
$lastopen = $lastcan['open'];   echo "<br> open ".$lastopen;
$lastlow = $lastcan['low'];     echo "<br> low ". $lastlow;
$lasthigh = $lastcan['high'];     echo "<br> high ". $lasthigh;
$lastdif = $lastclose-$lastopen;  
echo "</font>";
if($lastopen > $lastclose){ $lastexit = $lastclose-$lastdif; echo "<font color=#001bff><br> exit point ". $lastexit."</font>";}
if($lastclose < $lastopen && $cuclose > $cuopen && $cuclose < $close){ echo " BUY "; $sig="BUY";} else { echo " WAIT "; $sig="WAIT";}
if($lastclose < $lastopen && $cuclose > $cuopen){ echo " WAIT "; $sig="WAIT";}
if($cumin > $close){ echo " SELL "; $sig="SELL";}

if($time == "05:30"){echo " time ok "; 
    $candlein = mysqli_query($connection,"insert into wazir (open,close,low,high,date,sig) values ('$open','$close','$low','$high','$date','$sig')");
}else { echo " time not ok ";}
