<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Weather App</title>
        <link rel="stylesheet" href="/css/main.css">
        <script src="https://rawgithub.com/darkskyapp/skycons/master/skycons.js"></script>
        <script src="/js/app.js" defer></script>
        <body class="bg-gray-200">
        <div id="app" class="flex justify-center pt-20">
            <weather-app></weather-app>
        </div>
    </body>
</html>
