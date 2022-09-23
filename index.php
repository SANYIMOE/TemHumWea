<?php 
/*    Config    */
$TIMEZONE='Asia/Shanghai'; // Set Time Zone
$TIMETYPE='m/d/Y h:i:s a'; // Set the time and date format (default: month/day/year hour: minute: second morning/afternoon)
$BGCOLOR='skyblue'; // Set the background color, which supports html.
$API=''; // Set weather API (currently supports Hefeng weather, weather awareness, etc.)
$DATAFILE='./data/'; // Data folder (default is './data/')
$DATANAME='lastest.txt'; // Default data file name (default is 'lastest.txt')
/*    End Config    */
/*
* TemHumWea
* Author：Chihiro
*/
/*    Index    */
header("Content-Type:text/html;charset=UTF-8"); // Encoded in UTF-8
date_default_timezone_set($TIMEZONE); // Set Time Zone
$DATETIME=date($TIMETYPE, time()); // Get Time Date
$DATA=json_decode(file_get_contents("compress.zlib://".$API), true);  // Get and parse API
$GET=$_GET['GET']; // Get your access information
switch ($GET){ // Access information to determine output
    default: // Default information
        echo '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover">'; //Set wiewport
        echo '<title>TemHumWea</title>'; // Set browser title
        echo '<body bgcolor="'.$BGCOLOR.'">'; // Set background color
        echo '<br><center><h1>TemHumWea</h1></center>'; // Set page title
        echo '<center><h3>City:&nbsp;City</h3></center>';
        echo '<center><h3>Current time:&nbsp;'.$DATETIME.';&nbsp;API Update Time:&nbsp;'.$DATA['updateTime'].'</h3></center>'; // Display time
        echo '<center><h3>Current temperature:&nbsp;'.$DATA['now']['temp'].'˚C;&nbsp;Current humidity:&nbsp;'.$DATA['now']['humidity'].'%'.';&nbsp;Current weather:&nbsp;'.$DATA['now']['text'].'</h3></center>'; // Real-time information
        /*    Old temperature and humidity records    */
        $TEXT_DATA_LASTEST=file_get_contents("compress.zlib://".$DATAFILE.$DATANAME); // Obtain old temperature and humidity records
        echo '<center><a href="?GET=CRON"><button>Update Data in the form by hand!</button></a></center>
            <center>
                <table border="1">
                    <tr><td>Time</td><td>Temperature(˚C)</td><td>Humidity(%)</td><td>Weather</td></tr>
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-67,-45)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-36,-34)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-21,-19)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-8,-2)).'</td></tr>'.'
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-136,-114)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-105,-103)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-90,-88)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-77,-71)).'</td></tr>'.'
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-208,-182)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-174,-172)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-159,-157)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-146,-140)).'</td></tr>'.'
                    <tr><td>Time</td><td>Temperature(˚C)</td><td>Humidity(%)</td><td>Weather</td></tr>
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-274,-252)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-243,-241)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-228,-226)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-215,-209)).'</td></tr>'.'
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-343,-321)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-312,-310)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-297,-295)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-284,-278)).'</td></tr>'.'
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-412,-390)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-381,-379)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-366,-364)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-353,-347)).'</td></tr>'.'
                    <tr><td>Time</td><td>Temperature(˚C)</td><td>Humidity(%)</td><td>Weather</td></tr>
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-481,-459)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-450,-448)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-435,-433)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-422,-416)).'</td></tr>'.'
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-550,-528)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-519,-517)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-504,-502)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-491,-485)).'</td></tr>'.'
                    <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-619,-597)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-588,-586)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-573,-571)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-560,-554)).'</td></tr>'.'
                </table>
            </center><br>';
        /*    end:Old temperature and humidity records    */
        echo "<center><a href='".$DATAFILE.$DATANAME."'download='data.txt'><button style='width:200px;height:60px;'><font size='5'>日志下载</font></button></a></center>";
        echo '<center><h4>Current API:&nbsp;'.$API.'</h4></center>'; // Show APIs currently in use
    break;
    case 'CRON':
        echo '<meta http-equiv="refresh" content="3;url=/">'; // Jump Page
        echo '<title>Cron</title><style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #4a86e8; color: #fff;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>Cron Success!&nbsp;<br/></p><span style="font-size: 25px">The page will jump in 3 seconds.</span></div>'; // Display capture completion prompt
        file_put_contents($DATAFILE.$DATANAME,"\r\n".$DATETIME.' 温度: '.$DATA['now']['temp'].'˚C; 湿度: '.$DATA['now']['humidity'].'%'.'; 天气: 失败; ',FILE_APPEND); // Update file
    break;
}
/*    End Index    */
?> 
