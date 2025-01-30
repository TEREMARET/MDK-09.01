<form method="post">
    Введите название города<br>
    <input type="text" name="town">
	<input type="submit" value="Продолжить">
</form>

<?php
$apiKey = "9c28a35c6b89e0fa6413c66006db4ce9";
$lat;
$lon;

if(isset($_POST["town"])){
    $apiUrl="http://api.openweathermap.org/geo/1.0/direct?q=" . $_POST["town"] . "&limit=2&appid=" . $apiKey;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);
    curl_close($curl);

    if (curl_errno($curl)){
        echo "Ошибка: " . curl_error($curl);}
    else {
        $data=json_decode($response,1);
        $lat=$data[0]["lat"];
        $lon=$data[0]["lon"];
 
        $apiUrl2 = "http://api.openweathermap.org/data/2.5/weather?lat=" . $lat . "&lon=" . $lon . "&lang=ru&units=metric&APPID=" . $apiKey;;

        $curl2 = curl_init();
        curl_setopt($curl2, CURLOPT_URL, $apiUrl2);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
        $response2 = curl_exec($curl2);
        curl_close($curl2);

        $data2 = json_decode($response2, true);
        echo "Город: " . $data2["name"] . "<br>" .
        "Погода: " . $data2["weather"][0]["description"] . "<br>" .
        "Температура: " . $data2["main"]["temp"] . "° C";
        }
    } 
?>