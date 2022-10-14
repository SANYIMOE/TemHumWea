# TemHumWea
Temperature, humidity and weather.

A simple script for obtaining temperature, humidity and weather.

## Usage method
1. Decompress the source code
2. One visit
3. Open the index.php file with a text editor and modify the config item
4. Configure the scheduled task and visit 'http (s)://yourdomain/?GET=CRON’
5. After all the above configurations are completed, you will get a good access address for public temperature, humidity and weather.

## API interface
The system provides an API interface. You only need to decode it in json mode‘ http(s)://yourdomain/?GET=API ’OK.

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

# TemHumWea
温湿度和天气

简约而不简单的温湿度和天气获取脚本
