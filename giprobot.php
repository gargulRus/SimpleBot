<?php
    //Функция получения данных о валюте
    function CBR_XML_Daily_Ru() {
        $json_daily_file = __DIR__.'/daily.json';
        if (!is_file($json_daily_file) || filemtime($json_daily_file) < time() - 3600) {
            if ($json_daily = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js')) {
              file_put_contents($json_daily_file, $json_daily);
            }
        } 
     return json_decode(file_get_contents($json_daily_file));
    }
//Вызываем "валютную" функцию и вносим данные в переменные
$data = CBR_XML_Daily_Ru();
$usd = "{$data->Valute->USD->Value}";
$eur = "{$data->Valute->EUR->Value}";
//Получаем данные погоды через API 
$wether = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Moscow,ru&appid=<?APP_ID?>=metric');
$json_string = json_decode($wether, JSON_PRETTY_PRINT);
//Формируем текстовую строку для сообщения боту и передаем ее в скрипт
$mestobot = "Валюта сегодня \r\n Курс Доллара: - ".$usd." \r\n Курс Евро - ".$eur ."\r\n Температура в ".$json_string[name]."  сейчас ".$json_string[main][temp]." C " ;  
    echo $mestobot;
$res = shell_exec ("sudo /var/www/html/sendob.sh '$mestobot'");
?>