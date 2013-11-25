<!doctype html>
<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <title>Тестовое задание для Timeweb</title>

        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="/css/gridset.css" />

        <link rel="stylesheet" type="text/css" href="/css/semantic.min.css">

        <link rel="stylesheet" type="text/css" href="/css/styles.css" />

        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
        <script src="/js/semantic.min.js"></script>
        <script src="/js/script.js"></script>

    </head>
    <body>
        <h1 class="ui center aligned header">Тестовое задание для Timeweb</h1>

        <div class="db2-db3 m-all t2-t3">
            <div class="ui menu segment left aligned">
                <a class="item<?php echo ( (!isset($menu) || "home" == $menu) ? " active" : "")?>" href="/">Форма запроса</a>
                <a class="item<?php echo ( (isset($menu) && "results" == $menu) ? " active" : "")?>" href="/results/">Список результатов</a>
            </div>
