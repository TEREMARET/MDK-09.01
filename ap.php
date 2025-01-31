<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Погода в городах</title>
    </head>
    <body>
        <form method="POST">
            <input type="text" name="city">
            <button type="submit">Вывести</button>
        </form>
        <div class="wether">
            <?php
            $apiKey = "baf09e3bac8c3487c0ddcaca6fb88344";
            $city = urldecode(trim($_POST["city"]));
            $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=ru";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $apiUrl); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                echo "Ошибка запроса: " . curl_error($curl);
            } else {
                $data = json_decode($response, true);

                if ($data['cod'] == 200){
                    echo "Город: " . $_POST ["city"] . "<br>";
                    echo "Температура: " . round($data['main']['temp']) . " °C". "<br>";
                    echo "Погода: " . ($data['weather'][0]['description']) . "<br>";
                } else {
                    echo "Ошибка";
                }
            }

            curl_close($curl);

            ?>
        </div>
    </body>
</html>