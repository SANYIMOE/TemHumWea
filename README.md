# TemHumWea
# English
English | <a href="#中文-简体">中文-简体</a>
Temperature, humidity and weather.

A simple script for obtaining temperature, humidity and weather.

## Usage method
1. Decompress the source code
2. One visit
3. Open the index.php file with a text editor and modify the config item
4. Configure the scheduled task and visit 'http (s)://yourdomain/?GET=CRON’
5. After all the above configurations are completed, you will get a good access address for public temperature, humidity and weather.完成以上所有配置后，您将获得一个很好的公共温度、湿度和天气访问地址。

## API interface
The system provides an API interface. You only need to decode it in json mode ‘http(s)://yourdomain/?GET=API’OK.

### API Parameter Description
|Parameter|Description|
|:----:|:----:|
|code|Status Code|
|now|Real-time info|
|updateTime|Time for the system update data|
|APIupdateTime|Time for API update data|
|temp|Temperature|
|humidity|Humidity|
|text|Weather|
|windDir|wind direction|
|lastest|The lastest time data|
|today|Today data|
|morning|Morning data for some days|
|noon|Noon data for some days|
|afternoon|Afternoon data for some days|
|history|History data|
|yesterday|Data for yesterday|
|beforeyesterday|Data for the day before yesterday|

# 中文-简体
中文-简体 | <a href="#English">English</a>
温湿度和天气

简约而不简单的温湿度和天气获取脚本

## 使用方法
1. 解压发行版源代码
2. 访问一次
3. 用文本编辑器打开index.php并修改里面的config项
4. 设置好计划任务访问'http (s)://yourdomain/?GET=CRON’
5. 完成以上所有配置后，您将获得一个很好的公共温度、湿度和天气的服务

## API接口
本系统提供API接口，您可以使用JSON的方式来解析‘http(s)://yourdomain/?GET=API’。

### API参数说明
|参数|说明|
|:----:|:----:|
|code|状态代码|
|now|实时信息|
|updateTime|系统更新数据时间|
|APIupdateTime|API更新数据时间|
|temp|温度|
|humidity|湿度|
|text|天气|
|windDir|风向|
|lastest|最后的数据|
|today|今天的数据|
|morning|上午数据|
|noon|中午数据|
|afternoon|下午数据|
|history|历史数据|
|yesterday|昨天的数据|
|beforeyesterday|前天的数据|
