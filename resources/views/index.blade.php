<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>

    </style>
</head>
<body>
<div id="app" class="p-4">
    <div ref="overlay"></div>
    <div ref="loading" v-if="loading" style="position: absolute; left: 50%; top: 50%; z-index: 100000;">
        <img src="{{asset('loader.gif')}}" class="img-fluid mx-auto d-block" style="height: 200px" alt="">
    </div>
    <router-view></router-view>
</div>
@vite(['resources/js/app.js'])
</body>
</html>
