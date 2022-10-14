<?php 
/*    config    */
$TIMEZONE='Asia/Shanghai'; //Set Time Zone
$TIMETYPE='m/d/Y h:i:s a'; //Set the time and date format (default: m/d/Y h:i:s a)
$BGCOLOR=''; //Background Color
$API=''; //Set weather API
$DATAFILE='data'; //Log data file name (data by default)
$DATABASEFILENAME='database'; //Database file name (database by default)
$SITENAME='TemHumWea'; //Site Name
$CITY=''; //City
$BEIAN=''; //Beian
$CRON=''; //After setting, it will be updated regularly at this time every day. Multiple will be split by | | in a 24-hour format.
$CRON1='8:00'; //After setting, the data will be updated regularly at this time of day. The first data of each day is in 24-hour format.
$CRON2='12:00'; //After setting, the data will be updated regularly at this time of day, the second time of day, in a 24-hour format.
$CRON3='16:00'; //After setting, the data will be updated regularly at this time every day. The data will be updated for the third time every day in a 24-hour format.
/*    End config    */

/*
* TemHumWea
* Author：Chihiro
* Please do not modify the following information in case of site problems
* Modifying the information in the main item causes problems in the site without technical support
*/
/*    main    */
header("Content-Type:text/html;charset=UTF-8"); //Encoded in UTF-8
date_default_timezone_set($TIMEZONE); //Set Time Zone
$DATETIME=date($TIMETYPE, time()); //Configuration time date
$DATABASEFILE = $DATABASEFILENAME.'.json'; //Detection database file
if(!file_exists($DATABASEFILE)){ //If the database file does not exist
    file_put_contents($DATABASEFILE,''); //Create database file
}
if(!file_exists($DATAFILE.'.txt')){ //If the log data file does not exist
    file_put_contents($DATAFILE.'.txt',''); //Create log data file
}
$DATABASELOAD=json_decode(file_get_contents("compress.zlib://".$DATABASEFILENAME.'.json'), true);  //Get and parse the database file
$GET=$_GET['GET']; //Get your access information
switch ($GET){ //Access information to determine output
    default: //Do not add request suffix
        echo '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover">'; //Set wiewport
        echo '<title>'.$SITENAME.'</title>'; //Set browser title
        echo '<body bgcolor="'.$BGCOLOR.'">'; //Set background color
        echo '<br><center><h1>'.$SITENAME.'</h1></center>'; //Show Page Title
        echo '<center><h3>City:&nbsp;'.$CITY.'</h3></center>';
        echo '<center><h3>Update Time:&nbsp;'.$DATABASELOAD['now']['updateTime'].';&nbsp;API Update Time:&nbsp;'.$DATABASELOAD['now']['APIupdateTime'].'</h3></center>'; //Display time
        echo '<center><h3>Current Temperature:&nbsp;'.$DATABASELOAD['now']['temp'].'˚C;&nbsp;Current Humidity:&nbsp;'.$DATABASELOAD['now']['humidity'].'%'.'</h3></center>'; //Display temperature and humidity
        echo '<center><h3>'.'Current Weather:&nbsp;'.$DATABASELOAD['now']['text'].';&nbsp;Current Wind Direction:&nbsp;'.$DATABASELOAD['now']['windDir'].'</h3></center>'; //Display weather and wind direction
        /*    Temperature and humidity record form    */
        echo '<center>
            <table border="1">
                <tr><td>Time</td><td>Temperature(˚C)</td><td>Humidity(%)</td><td>Weather</td><td>Wind Direction</td></tr>
                <tr><td>'.$DATABASELOAD['lastest']['updateTime'].'</td><td>'.$DATABASELOAD['lastest']['temp'].'</td><td>'.$DATABASELOAD['lastest']['humidity'].'</td><td>'.$DATABASELOAD['lastest']['text'].'</td><td>'.$DATABASELOAD['lastest']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['today']['morning']['updateTime'].'</td><td>'.$DATABASELOAD['today']['morning']['temp'].'</td><td>'.$DATABASELOAD['today']['morning']['humidity'].'</td><td>'.$DATABASELOAD['today']['morning']['text'].'</td><td>'.$DATABASELOAD['today']['morning']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['today']['noon']['updateTime'].'</td><td>'.$DATABASELOAD['today']['noon']['temp'].'</td><td>'.$DATABASELOAD['today']['noon']['humidity'].'</td><td>'.$DATABASELOAD['today']['noon']['text'].'</td><td>'.$DATABASELOAD['today']['noon']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['today']['afternoon']['updateTime'].'</td><td>'.$DATABASELOAD['today']['afternoon']['temp'].'</td><td>'.$DATABASELOAD['today']['afternoon']['humidity'].'</td><td>'.$DATABASELOAD['today']['afternoon']['text'].'</td><td>'.$DATABASELOAD['today']['afternoon']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['history']['yesterday']['morning']['updateTime'].'</td><td>'.$DATABASELOAD['history']['yesterday']['morning']['temp'].'</td><td>'.$DATABASELOAD['history']['yesterday']['morning']['humidity'].'</td><td>'.$DATABASELOAD['history']['yesterday']['morning']['text'].'</td><td>'.$DATABASELOAD['history']['yesterday']['morning']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['history']['yesterday']['noon']['updateTime'].'</td><td>'.$DATABASELOAD['history']['yesterday']['noon']['temp'].'</td><td>'.$DATABASELOAD['history']['yesterday']['noon']['humidity'].'</td><td>'.$DATABASELOAD['history']['yesterday']['noon']['text'].'</td><td>'.$DATABASELOAD['history']['yesterday']['noon']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['history']['yesterday']['afternoon']['updateTime'].'</td><td>'.$DATABASELOAD['history']['yesterday']['afternoon']['temp'].'</td><td>'.$DATABASELOAD['history']['yesterday']['afternoon']['humidity'].'</td><td>'.$DATABASELOAD['history']['yesterday']['afternoon']['text'].'</td><td>'.$DATABASELOAD['history']['yesterday']['afternoon']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['history']['beforeyesterday']['morning']['updateTime'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['morning']['temp'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['morning']['humidity'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['morning']['text'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['morning']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['history']['beforeyesterday']['noon']['updateTime'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['noon']['temp'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['noon']['humidity'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['noon']['text'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['noon']['windDir'].'</td></tr>'.'
                <tr><td>'.$DATABASELOAD['history']['beforeyesterday']['afternoon']['updateTime'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['afternoon']['temp'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['afternoon']['humidity'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['afternoon']['text'].'</td><td>'.$DATABASELOAD['history']['beforeyesterday']['afternoon']['windDir'].'</td></tr>'.'
            </table>
            </center><br>';
        /*    End:Temperature and humidity record form    */
        echo "<center><a href='".$DATAFILE.".txt"."'download='data.txt'><button style='width:200px;height:60px;'><font size='5'>Log Download</font></button></a></center>";
        echo '<br><center><a href="https://beian.miit.gov.cn" target="_blank">'.$BEIAN.'</a></center>'; //Beian
    break;
    case 'CRON':
        $TIME=date('H:i', time()); //Configure Update Time
        echo '<meta http-equiv="refresh" content="3;url=/">'; //Jump Page
        echo '<title>计划任务</title><style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #4a86e8; color: #fff;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>Successfully executed the scheduled task!&nbsp;<br/></p><span style="font-size: 25px">The page will jump in 3 seconds</span></div>'; //Display successful execution prompt
        $DATA=json_decode(file_get_contents("compress.zlib://".$API), true);  //获取并解析API
        $JSONDATA=array(); //数组形式
        $JSONDATA['now']['updateTime']=$DATETIME; //实时更新时间
        $JSONDATA['now']['APIupdateTime']=$DATA['updateTime']; //API更新时间
        $JSONDATA['now']['temp']=$DATA['now']['temp']; //实时温度
        $JSONDATA['now']['humidity']=$DATA['now']['humidity']; //实时湿度
        $JSONDATA['now']['text']=$DATA['now']['text']; //实时天气
        $JSONDATA['now']['windDir']=$DATA['now']['windDir']; //实时风向
        file_put_contents($DATABASEFILE,json_encode($JSONDATA,JSON_UNESCAPED_UNICODE)); //更新实时数据
        if($TIME==$CRON){ //如果时间为指定时间
            $JSONDATA['lastest']['updateTime']=$DATETIME; //更新时间历史
            $JSONDATA['lastest']['APIupdateTime']=$DATA['updateTime']; //API更新时间历史
            $JSONDATA['lastest']['temp']=$DATA['now']['temp']; //温度历史
            $JSONDATA['lastest']['humidity']=$DATA['now']['humidity']; //湿度历史
            $JSONDATA['lastest']['text']=$DATA['now']['text']; //天气历史
            $JSONDATA['lastest']['windDir']=$DATA['now']['windDir']; //风向历史
            file_put_contents($DATAFILE.".txt","\r\n".$DATETIME.' 温度: '.$DATA['now']['temp'].'˚C; 湿度: '.$DATA['now']['humidity'].'%'.'; 天气: '.$DATA['now']['text'].'; 风向: '.$DATA['now']['windDir'],FILE_APPEND); //更新文件
            file_put_contents($DATABASEFILE,json_encode($JSONDATA,JSON_UNESCAPED_UNICODE)); //编码并写入数据到数据库文件
        }
        if($TIME==$CRON1){ //如果时间为指定时间
            $JSONDATA['today']['morning']['updateTime']=$DATETIME; //更新时间历史
            $JSONDATA['today']['morning']['APIupdateTime']=$DATA['updateTime']; //API更新时间历史
            $JSONDATA['today']['morning']['temp']=$DATA['now']['temp']; //温度历史
            $JSONDATA['today']['morning']['humidity']=$DATA['now']['humidity']; //湿度历史
            $JSONDATA['today']['morning']['text']=$DATA['now']['text']; //天气历史
            $JSONDATA['today']['morning']['windDir']=$DATA['now']['windDir']; //风向历史
            file_put_contents($DATAFILE.".txt","\r\n".$DATETIME.' 温度: '.$DATA['now']['temp'].'˚C; 湿度: '.$DATA['now']['humidity'].'%'.'; 天气: '.$DATA['now']['text'].'; 风向: '.$DATA['now']['windDir'],FILE_APPEND); //更新文件
            file_put_contents($DATABASEFILE,json_encode($JSONDATA,JSON_UNESCAPED_UNICODE)); //编码并写入数据到数据库文件
        }
        if($TIME==$CRON2){ //如果时间为指定时间
            $JSONDATA['today']['noon']['updateTime']=$DATETIME; //更新时间历史
            $JSONDATA['today']['noon']['APIupdateTime']=$DATA['updateTime']; //API更新时间历史
            $JSONDATA['today']['noon']['temp']=$DATA['now']['temp']; //温度历史
            $JSONDATA['today']['noon']['humidity']=$DATA['now']['humidity']; //湿度历史
            $JSONDATA['today']['noon']['text']=$DATA['now']['text']; //天气历史
            $JSONDATA['today']['noon']['windDir']=$DATA['now']['windDir']; //风向历史
            file_put_contents($DATAFILE.".txt","\r\n".$DATETIME.' 温度: '.$DATA['now']['temp'].'˚C; 湿度: '.$DATA['now']['humidity'].'%'.'; 天气: '.$DATA['now']['text'].'; 风向: '.$DATA['now']['windDir'],FILE_APPEND); //更新文件
            file_put_contents($DATABASEFILE,json_encode($JSONDATA,JSON_UNESCAPED_UNICODE)); //编码并写入数据到数据库文件
        }
        if($TIME==$CRON3){ //如果时间为指定时间
            $JSONDATA['today']['afternoon']['updateTime']=$DATETIME; //更新时间历史
            $JSONDATA['today']['afternoon']['APIupdateTime']=$DATA['updateTime']; //API更新时间历史
            $JSONDATA['today']['afternoon']['temp']=$DATA['now']['temp']; //温度历史
            $JSONDATA['today']['afternoon']['humidity']=$DATA['now']['humidity']; //湿度历史
            $JSONDATA['today']['afternoon']['text']=$DATA['now']['text']; //天气历史
            $JSONDATA['today']['afternoon']['windDir']=$DATA['now']['windDir']; //风向历史
            file_put_contents($DATAFILE.".txt","\r\n".$DATETIME.' 温度: '.$DATA['now']['temp'].'˚C; 湿度: '.$DATA['now']['humidity'].'%'.'; 天气: '.$DATA['now']['text'].'; 风向: '.$DATA['now']['windDir'],FILE_APPEND); //更新文件
            file_put_contents($DATABASEFILE,json_encode($JSONDATA,JSON_UNESCAPED_UNICODE)); //编码并写入数据到数据库文件
        }
        if($TIME=='23:59'){ //如果时间为早上0点前，则归档昨天和前天
            $JSONDATA['history']['yesterday']['morning']['updateTime']=$DATABASELOAD['today']['morning']['updateTime']; //更新时间历史
            $JSONDATA['history']['yesterday']['morning']['APIupdateTime']=$DATABASELOAD['today']['morning']['APIupdateTime']; //API更新时间历史
            $JSONDATA['history']['yesterday']['morning']['temp']=$DATABASELOAD['today']['morning']['temp']; //温度历史
            $JSONDATA['history']['yesterday']['morning']['humidity']=$DATABASELOAD['today']['morning']['humidity']; //湿度历史
            $JSONDATA['history']['yesterday']['morning']['text']=$DATABASELOAD['today']['morning']['text']; //天气历史
            $JSONDATA['history']['yesterday']['morning']['windDir']=$DATABASELOAD['today']['morning']['windDir']; //风向历史
            $JSONDATA['history']['yesterday']['noon']['updateTime']=$DATABASELOAD['today']['noon']['updateTime']; //更新时间历史
            $JSONDATA['history']['yesterday']['noon']['APIupdateTime']=$DATABASELOAD['today']['noon']['APIupdateTime']; //API更新时间历史
            $JSONDATA['history']['yesterday']['noon']['temp']=$DATABASELOAD['today']['noon']['temp']; //温度历史
            $JSONDATA['history']['yesterday']['noon']['humidity']=$DATABASELOAD['today']['noon']['humidity']; //湿度历史
            $JSONDATA['history']['yesterday']['noon']['text']=$DATABASELOAD['today']['noon']['text']; //天气历史
            $JSONDATA['history']['yesterday']['noon']['windDir']=$DATABASELOAD['today']['noon']['windDir']; //风向历史
            $JSONDATA['history']['yesterday']['afternoon']['updateTime']=$DATABASELOAD['today']['afternoon']['updateTime']; //更新时间历史
            $JSONDATA['history']['yesterday']['afternoon']['APIupdateTime']=$DATABASELOAD['today']['afternoon']['APIupdateTime']; //API更新时间历史
            $JSONDATA['history']['yesterday']['afternoon']['temp']=$DATABASELOAD['today']['afternoon']['temp']; //温度历史
            $JSONDATA['history']['yesterday']['afternoon']['humidity']=$DATABASELOAD['today']['afternoon']['humidity']; //湿度历史
            $JSONDATA['history']['yesterday']['afternoon']['text']=$DATABASELOAD['today']['afternoon']['text']; //天气历史
            $JSONDATA['history']['yesterday']['afternoon']['windDir']=$DATABASELOAD['today']['afternoon']['windDir']; //风向历史
            $JSONDATA['history']['beforeyesterday']['morning']['updateTime']=$JSONDATA['history']['yesterday']['morning']['updateTime']; //更新时间历史
            $JSONDATA['history']['beforeyesterday']['morning']['APIupdateTime']=$JSONDATA['history']['yesterday']['morning']['APIupdateTime']; //API更新时间历史
            $JSONDATA['history']['beforeyesterday']['morning']['temp']=$JSONDATA['history']['yesterday']['morning']['temp']; //温度历史
            $JSONDATA['history']['beforeyesterday']['morning']['humidity']=$JSONDATA['history']['yesterday']['morning']['humidity']; //湿度历史
            $JSONDATA['history']['beforeyesterday']['morning']['text']=$JSONDATA['history']['yesterday']['morning']['text']; //天气历史
            $JSONDATA['history']['beforeyesterday']['morning']['windDir']=$JSONDATA['history']['yesterday']['morning']['windDir']; //风向历史
            $JSONDATA['history']['beforeyesterday']['noon']['updateTime']=$JSONDATA['history']['yesterday']['noon']['updateTime']; //更新时间历史
            $JSONDATA['history']['beforeyesterday']['noon']['APIupdateTime']=$JSONDATA['history']['yesterday']['noon']['APIupdateTime']; //API更新时间历史
            $JSONDATA['history']['beforeyesterday']['noon']['temp']=$JSONDATA['history']['yesterday']['noon']['temp']; //温度历史
            $JSONDATA['history']['beforeyesterday']['noon']['humidity']=$JSONDATA['history']['yesterday']['noon']['humidity']; //湿度历史
            $JSONDATA['history']['beforeyesterday']['noon']['text']=$JSONDATA['history']['yesterday']['noon']['text']; //天气历史
            $JSONDATA['history']['beforeyesterday']['noon']['windDir']=$JSONDATA['history']['yesterday']['noon']['windDir']; //风向历史
            $JSONDATA['history']['beforeyesterday']['afternoon']['updateTime']=$JSONDATA['history']['yesterday']['afternoon']['updateTime']; //更新时间历史
            $JSONDATA['history']['beforeyesterday']['afternoon']['APIupdateTime']=$JSONDATA['history']['yesterday']['afternoon']['APIupdateTime']; //API更新时间历史
            $JSONDATA['history']['beforeyesterday']['afternoon']['temp']=$JSONDATA['history']['yesterday']['afternoon']['temp']; //温度历史
            $JSONDATA['history']['beforeyesterday']['afternoon']['humidity']=$JSONDATA['history']['yesterday']['afternoon']['humidity']; //湿度历史
            $JSONDATA['history']['beforeyesterday']['afternoon']['text']=$JSONDATA['history']['yesterday']['afternoon']['text']; //天气历史
            $JSONDATA['history']['beforeyesterday']['afternoon']['windDir']=$JSONDATA['history']['yesterday']['afternoon']['windDir']; //风向历史
            file_put_contents($DATABASEFILE,json_encode($JSONDATA,JSON_UNESCAPED_UNICODE)); //编码并写入数据到数据库文件
        }
    break;
    case 'API':
        header("Content-type:application/json;charset=utf8"); //将数据识别为JSON格式
        $JSONAPI=array(); //数组形式
        $JSONAPI['code']="200"; //状态代码
        $JSONAPI['now']['updateTime']=$DATABASELOAD['now']['updateTime']; //实时更新时间
        $JSONAPI['now']['APIupdateTime']=$DATABASELOAD['now']['APIupdateTime']; //API更新时间
        $JSONAPI['now']['temp']=$DATABASELOAD['now']['temp']; //实时温度
        $JSONAPI['now']['humidity']=$DATABASELOAD['now']['humidity']; //实时湿度
        $JSONAPI['now']['text']=$DATABASELOAD['now']['text']; //实时天气
        $JSONAPI['now']['windDir']=$DATABASELOAD['now']['windDir']; //实时风向
        $JSONAPI['lastest']['updateTime']=$DATABASELOAD['lastest']['updateTime']; //更新时间历史
        $JSONAPI['lastest']['APIupdateTime']=$DATABASELOAD['lastest']['APIupdateTime']; //API更新时间历史
        $JSONAPI['lastest']['temp']=$DATABASELOAD['lastest']['temp']; //温度历史
        $JSONAPI['lastest']['humidity']=$DATABASELOAD['lastest']['humidity']; //湿度历史
        $JSONAPI['lastest']['text']=$DATABASELOAD['lastest']['text']; //天气历史
        $JSONAPI['lastest']['windDir']=$DATABASELOAD['lastest']['windDir']; //风向历史
        $JSONAPI['today']['morning']['updateTime']=$DATABASELOAD['today']['morning']['updateTime']; //更新时间历史
        $JSONAPI['today']['morning']['APIupdateTime']=$DATABASELOAD['today']['morning']['APIupdateTime']; //API更新时间
        $JSONAPI['today']['morning']['temp']=$DATABASELOAD['today']['morning']['temp']; //温度历史
        $JSONAPI['today']['morning']['humidity']=$DATABASELOAD['today']['morning']['humidity']; //湿度历史
        $JSONAPI['today']['morning']['text']=$DATABASELOAD['today']['morning']['text']; //天气历史
        $JSONAPI['today']['morning']['windDir']=$DATABASELOAD['today']['morning']['windDir']; //风向历史
        $JSONAPI['today']['noon']['updateTime']=$DATABASELOAD['today']['noon']['updateTime']; //更新时间历史
        $JSONAPI['today']['noon']['APIupdateTime']=$DATABASELOAD['today']['noon']['APIupdateTime']; //API更新时间
        $JSONAPI['today']['noon']['temp']=$DATABASELOAD['today']['noon']['temp']; //温度历史
        $JSONAPI['today']['noon']['humidity']=$DATABASELOAD['today']['noon']['humidity']; //湿度历史
        $JSONAPI['today']['noon']['text']=$DATABASELOAD['today']['noon']['text']; //天气历史
        $JSONAPI['today']['noon']['windDir']=$DATABASELOAD['today']['noon']['windDir']; //风向历史
        $JSONAPI['today']['afternoon']['updateTime']=$DATABASELOAD['today']['afternoon']['updateTime']; //更新时间历史
        $JSONAPI['today']['afternoon']['APIupdateTime']=$DATABASELOAD['today']['afternoon']['APIupdateTime']; //API更新时间
        $JSONAPI['today']['afternoon']['temp']=$DATABASELOAD['today']['afternoon']['temp']; //温度历史
        $JSONAPI['today']['afternoon']['humidity']=$DATABASELOAD['today']['afternoon']['humidity']; //湿度历史
        $JSONAPI['today']['afternoon']['text']=$DATABASELOAD['today']['afternoon']['text']; //天气历史
        $JSONAPI['today']['afternoon']['windDir']=$DATABASELOAD['today']['afternoon']['windDir']; //风向历史
        $JSONAPI['history']['yesterday']['morning']['updateTime']=$DATABASELOAD['history']['yesterday']['morning']['updateTime']; //更新时间历史
        $JSONAPI['history']['yesterday']['morning']['APIupdateTime']=$DATABASELOAD['history']['yesterday']['morning']['APIupdateTime']; //API更新时间
        $JSONAPI['history']['yesterday']['morning']['temp']=$DATABASELOAD['history']['yesterday']['morning']['temp']; //温度历史
        $JSONAPI['history']['yesterday']['morning']['humidity']=$DATABASELOAD['history']['yesterday']['morning']['humidity']; //湿度历史
        $JSONAPI['history']['yesterday']['morning']['text']=$DATABASELOAD['history']['yesterday']['morning']['text']; //天气历史
        $JSONAPI['history']['yesterday']['morning']['windDir']=$DATABASELOAD['history']['yesterday']['morning']['windDir']; //风向历史
        $JSONAPI['history']['yesterday']['noon']['updateTime']=$DATABASELOAD['history']['yesterday']['noon']['updateTime']; //更新时间历史
        $JSONAPI['history']['yesterday']['noon']['APIupdateTime']=$DATABASELOAD['history']['yesterday']['noon']['APIupdateTime']; //API更新时间
        $JSONAPI['history']['yesterday']['noon']['temp']=$DATABASELOAD['history']['yesterday']['noon']['temp']; //温度历史
        $JSONAPI['history']['yesterday']['noon']['humidity']=$DATABASELOAD['history']['yesterday']['noon']['humidity']; //湿度历史
        $JSONAPI['history']['yesterday']['noon']['text']=$DATABASELOAD['history']['yesterday']['noon']['text']; //天气历史
        $JSONAPI['history']['yesterday']['noon']['windDir']=$DATABASELOAD['history']['yesterday']['noon']['windDir']; //风向历史
        $JSONAPI['history']['yesterday']['afternoon']['updateTime']=$DATABASELOAD['history']['yesterday']['afternoon']['updateTime']; //更新时间历史
        $JSONAPI['history']['yesterday']['afternoon']['APIupdateTime']=$DATABASELOAD['history']['yesterday']['afternoon']['APIupdateTime']; //API更新时间
        $JSONAPI['history']['yesterday']['afternoon']['temp']=$DATABASELOAD['history']['yesterday']['afternoon']['temp']; //温度历史
        $JSONAPI['history']['yesterday']['afternoon']['humidity']=$DATABASELOAD['history']['yesterday']['afternoon']['humidity']; //湿度历史
        $JSONAPI['history']['yesterday']['afternoon']['text']=$DATABASELOAD['history']['yesterday']['afternoon']['text']; //天气历史
        $JSONAPI['history']['yesterday']['afternoon']['windDir']=$DATABASELOAD['history']['yesterday']['afternoon']['windDir']; //风向历史
        $JSONAPI['history']['beforeyesterday']['morning']['updateTime']=$DATABASELOAD['history']['beforeyesterday']['morning']['updateTime']; //更新时间历史
        $JSONAPI['history']['beforeyesterday']['morning']['APIupdateTime']=$DATABASELOAD['history']['beforeyesterday']['morning']['APIupdateTime']; //API更新时间
        $JSONAPI['history']['beforeyesterday']['morning']['temp']=$DATABASELOAD['history']['beforeyesterday']['morning']['temp']; //温度历史
        $JSONAPI['history']['beforeyesterday']['morning']['humidity']=$DATABASELOAD['history']['beforeyesterday']['morning']['humidity']; //湿度历史
        $JSONAPI['history']['beforeyesterday']['morning']['text']=$DATABASELOAD['history']['beforeyesterday']['morning']['text']; //天气历史
        $JSONAPI['history']['beforeyesterday']['morning']['windDir']=$DATABASELOAD['history']['beforeyesterday']['morning']['windDir']; //风向历史
        $JSONAPI['history']['beforeyesterday']['noon']['updateTime']=$DATABASELOAD['history']['beforeyesterday']['noon']['updateTime']; //更新时间历史
        $JSONAPI['history']['beforeyesterday']['noon']['APIupdateTime']=$DATABASELOAD['history']['beforeyesterday']['noon']['APIupdateTime']; //API更新时间
        $JSONAPI['history']['beforeyesterday']['noon']['temp']=$DATABASELOAD['history']['beforeyesterday']['noon']['temp']; //温度历史
        $JSONAPI['history']['beforeyesterday']['noon']['humidity']=$DATABASELOAD['history']['beforeyesterday']['noon']['humidity']; //湿度历史
        $JSONAPI['history']['beforeyesterday']['noon']['text']=$DATABASELOAD['history']['beforeyesterday']['noon']['text']; //天气历史
        $JSONAPI['history']['beforeyesterday']['noon']['windDir']=$DATABASELOAD['history']['beforeyesterday']['noon']['windDir']; //风向历史
        $JSONAPI['history']['beforeyesterday']['afternoon']['updateTime']=$DATABASELOAD['history']['beforeyesterday']['afternoon']['updateTime']; //更新时间历史
        $JSONAPI['history']['beforeyesterday']['afternoon']['APIupdateTime']=$DATABASELOAD['history']['beforeyesterday']['afternoon']['APIupdateTime']; //API更新时间
        $JSONAPI['history']['beforeyesterday']['afternoon']['temp']=$DATABASELOAD['history']['beforeyesterday']['afternoon']['temp']; //温度历史
        $JSONAPI['history']['beforeyesterday']['afternoon']['humidity']=$DATABASELOAD['history']['beforeyesterday']['afternoon']['humidity']; //湿度历史
        $JSONAPI['history']['beforeyesterday']['afternoon']['text']=$DATABASELOAD['history']['beforeyesterday']['afternoon']['text']; //天气历史
        $JSONAPI['history']['beforeyesterday']['afternoon']['windDir']=$DATABASELOAD['history']['beforeyesterday']['afternoon']['windDir']; //风向历史
        echo json_encode($JSONAPI,JSON_UNESCAPED_UNICODE); //以JSON格式编码并输出
    break;
}
/*    End 主项    */
?> 
