<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 11</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-slate-100 dark:bg-slate-800"> 
    <x-navbar></x-navbar>
    <div class="max-w-6xl mx-auto">
    {{$slot}}
    </div>

    

  </body>

</html>