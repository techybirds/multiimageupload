<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Image Uploader') }}</title>

    {{--<script src="{{ mix('js/manifest.js', 'dist') }}" defer></script>--}}
    {{--<script src="{{ mix('js/vendor.js', 'dist') }}" defer></script>--}}
    <script src="{{ asset('dist/js/app.js') }}" defer></script>

    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">


</head>
<body>
<div id="app">
    <app></app>
</div>
</body>
</html>
