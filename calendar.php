<!-- 萬年歷 -->
<link rel="stylesheet" href="calendar.css" media="all">
<?php 
#判斷從_GET[]所取得的資料
$month=$_GET['month']??date('n'); #判斷月
$year=$_GET['year']??date('Y'); #判斷年

#取得相關資料

$first_day=strtotime("$year-$month-1");     #當月的第一天秒數
$days=date("t",$first_day);                      #取得最後一天，天數
$final_day=strtotime("$year-$month-$days");     #當月的最後一天秒數
$first_week=date('w',$first_day);           #第一週星期幾 六
$final_week=date('w',$final_day);          #最後一週星期幾 日
$month_days = ($days + $first_week);      #當月總共要算幾天36
$month_week = ceil($month_days/7);           #當月有幾週 6




#建立月份陣列相關資料
$data = [];
 for($i=0;$i<$month_week;$i++){
    
      for($j=0;$j<7;$j++){
          #判斷要寫入空白還是天數
          if(($j<$first_week && $i == 0) ||($i==($month_week-1) && $final_week<$j)){
              $data[]="&nbsp;";
          }else{
              $data[]=$year.'-'.$month.'-'.($i*7)+$j-$first_week+1;
    
          }
      }
 }

#判斷年月有沒有超過
if($month==12){
    $nextmonth=1;
    $nextyear=$year + 1;
}else{
    $nextmonth=$month + 1;
    $nextyear=$year;
}
if($month==1){
    $prevmonth=12;
    $prevyear=$year - 1;
}else{
    $prevmonth=$month - 1;
    $prevyear=$year;
}
?>
<!--假日資料庫 -->
<?php
$holiday = ['2023-1-1'=>'元旦','2023-1-2'=>'補假','2023-1-20'=>'彈性放假日','2023-1-21'=>'除夕','2023-1-22'=>'春節',
'2023-1-23'=>'春節','2023-1-24'=>'春節','2023-1-25'=>'補假','2023-1-26'=>'補假',
'2023-1-27'=>'彈性放假日','2023-2-27'=>'彈性放假日','2023-2-28'=>'和平記念日',
'2023-4-3'=>'彈性放假日','2023-4-4'=>'國際兒童節','2023-4-5'=>'清明節',
'2023-5-1'=>'勞動節','2023-6-22'=>'端午節','2023-6-23'=>'彈性放假日','2023-9-29'=>'中秋節',
'2023-10-9'=>'彈性放假日','2023-10-10'=>'國慶日'];
?>
<!-- #flexbox -->
<div class="years"><?=$year?>年</div>
<!-- 上一月，這一月，下一月 -->
<div class="a-month">
<a href="index.php?year=<?=$prevyear;?>&month=<?=$prevmonth;?>"><?=$prevmonth;?>月</a>
<a href="index.php?year=<?=$year;?>&month=<?=$month;?>"><?=$month;?>月</a>
<a href="index.php?year=<?=$nextyear;?>&month=<?=$nextmonth;?>"><?=$nextmonth;?>月</a>
</div>
<hr>
<div class="contianer">
    <div class="tittle">星期日</div>
    <div class="tittle">星期一</div>
    <div class="tittle">星期二</div>
    <div class="tittle">星期三</div>
    <div class="tittle">星期四</div>
    <div class="tittle">星期五</div>
    <div class="tittle">星期六</div>

    <?php 

    #使用新的data格式判斷日期
    // 需要使用explode()取出$data[]日期和判斷空白
    for($i=0;$i<count($data);$i++){

        // $today=date('n-j');
        
        $d=($data[$i]=="&nbsp;")?'&nbsp;':explode('-',$data[$i])[2];  #取$i日期
        
        if($i%7==0 or $i%7==6) {
            if(isset($holiday[$data[$i]])){
                 $days=$holiday[$data[$i]];
                echo "<div class='holiday-day'>";
                echo $d;
                echo "<br>";
                echo "<span class='holiday-font'>$days</span>";
                echo "</div>";

            }else{
                echo "<div class='holiday'>";
                echo $d;
                echo "</div>";
                }
        }else{
            if(isset($holiday[$data[$i]])){
                $days=$holiday[$data[$i]];
               echo "<div class='holiday-day'>";
               echo $d;
               echo "<br>";
               echo "<span class='holiday-font'>$days</span>";
               echo "</div>";

           }else{
                echo "<div>";
                $days=(isset($holiday[$data[$i]]))?$holiday[$data[$i]]:"";
                echo $d;                
                echo "</div>";
    }
    }
}
   ?>
    
</div>