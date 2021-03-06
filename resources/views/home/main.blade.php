<!DOCTYPE html>
<html>
<head>
    <title>做视频</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{PUB}}assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/home_body.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/product.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/creation.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/supply.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/design.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/about.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/opinion.css">
    <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
</head>
<body>
{{--浏览器问题--}}
{{--@include('layout.browser')--}}
{{--浏览器问题--}}

    @include('layout.header')
    @include('layout.navigate')

    <!-- 中间内容 -->
    @yield('content')
    <!-- 中间内容 -->

    @include('layout.footer')

    @include('layout.qqchat')
</body>
</html>