<?php 
/*    配置项    */
$TIMEZONE='Asia/Shanghai'; //设置时区
$TIMETYPE='m/d/Y h:i:s a'; //设置时间日期格式(默认：月/日/年 时:分:秒 上午/下午)
$BGCOLOR='skyblue';
$API=''; //设置天气API(目前支持和风天气、心知天气等)
$DATAFILE='./data/'; //数据文件夹(默认为./data/)
$DATANAME='lastest.txt'; //默认数据文件名(默认为lastest.txt)
/*    End 配置项    */
/*
* 温湿度及天气获取源码
* 作者：喵千寻
*/
/*    主项    */
header("Content-Type:text/html;charset=UTF-8"); //以UTF-8编码
date_default_timezone_set($TIMEZONE); //设置时区
$DATETIME=date($TIMETYPE, time()); //配置时间日期
$DATA=json_decode(file_get_contents("compress.zlib://".$API), true);  //获取并解析API
$GET=$_GET['GET']; //获取您的访问信息
switch ($GET){ //以访问信息决定输出
    default: //不添加请求后缀
        echo '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover">'; //设置wiewport
        echo '<title>仓储部室外温湿度获取</title>'; //设置浏览器标题
        echo '<body bgcolor="'.$BGCOLOR.'">'; //设置背景颜色
        echo '<br><center><h1>仓储部室外温湿度获取</h1></center>'; //显示页面标题
        echo '<center><h3>城市:&nbsp;天津市东丽区</h3></center>';
        echo '<center><h3>当前时间:&nbsp;'.$DATETIME.';&nbsp;API更新时间:&nbsp;'.$DATA['updateTime'].'</h3></center>'; //显示时间
        echo '<center><h3>当前温度:&nbsp;'.$DATA['now']['temp'].'˚C;&nbsp;当前湿度:&nbsp;'.$DATA['now']['humidity'].'%'.';&nbsp;当前天气:&nbsp;'.$DATA['now']['text'].'</h3></center>'; //显示温湿度等信息
        /*    最近温湿度记录表格    */
        $TEXT_DATA_LASTEST=file_get_contents("compress.zlib://".$DATAFILE.$DATANAME); //获取以前的温湿度记录
        echo '<center>
            <table border="1">
                <tr><td>时间</td><td>温度(˚C)</td><td>湿度(%)</td><td>天气</td></tr>
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-67,-45)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-36,-34)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-21,-19)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-8,-2)).'</td></tr>'.'
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-136,-114)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-105,-103)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-90,-88)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-77,-71)).'</td></tr>'.'
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-208,-182)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-174,-172)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-159,-157)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-146,-140)).'</td></tr>'.'
                <tr><td>时间</td><td>温度(˚C)</td><td>湿度(%)</td><td>天气</td></tr>
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-274,-252)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-243,-241)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-228,-226)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-215,-209)).'</td></tr>'.'
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-343,-321)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-312,-310)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-297,-295)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-284,-278)).'</td></tr>'.'
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-412,-390)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-381,-379)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-366,-364)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-353,-347)).'</td></tr>'.'
                <tr><td>时间</td><td>温度(˚C)</td><td>湿度(%)</td><td>天气</td></tr>
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-481,-459)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-450,-448)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-435,-433)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-422,-416)).'</td></tr>'.'
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-550,-528)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-519,-517)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-504,-502)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-491,-485)).'</td></tr>'.'
                <tr><td>'.urldecode(substr($TEXT_DATA_LASTEST,-619,-597)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-588,-586)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-573,-571)).'</td><td>'.urldecode(substr($TEXT_DATA_LASTEST,-560,-554)).'</td></tr>'.'
            </table>
            </center><br>';
        /*    end:最近温湿度记录表格    */
        echo "<center><a href='".$DATAFILE.$DATANAME."'download='data.txt'><button style='width:200px;height:60px;'><font size='5'>日志下载</font></button></a></center>";
        //echo '<center><h4>当前使用API:&nbsp;'.$API.'</h4></center>'; //显示当前使用的API
    break;
    case 'CRON':
        echo '<meta http-equiv="refresh" content="3;url=/">'; //跳转页面
        echo '<title>计划任务</title><style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #4a86e8; color: #fff;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>计划任务执行成功!&nbsp;<br/></p><span style="font-size: 25px">页面将在3秒后跳转</span></div>'; //显示抓取完成提示
        file_put_contents($DATAFILE.$DATANAME,"\r\n".$DATETIME.' 温度: '.$DATA['now']['temp'].'˚C; 湿度: '.$DATA['now']['humidity'].'%'.'; 天气: 失败; ',FILE_APPEND); //更新文件
    break;
}
/*    End 主项    */
?> 
