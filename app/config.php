<?php

return array(
    'db' => array(
        'host' => 'localhost',
        'port' => '3307',
        'user' => 'root',
        'password' => 'islands-retail',
        'database' => 'temewebtw'
    ),
    'routes' => array(
        "home" => array(
            "path" => "/",
            "controller" => "parser",
            "action" => "form",
            "params" => array(
                "type" => "text",
                "url" => 'http://timeweb.ru'
            )
        ),
        "parser" => array(
            "path" => "/parser/(text|images|links)/?",
            "controller" => "parser",
            "action" => "parse",
            "method" => "ajax",
            "params" => array(
                "type" => "$1",
            )
        ),
        "result-list" => array(
            "path" => '/results/?(?:page/(\d+)?)?',
            "controller" => "parser",
            "action" => "list",
            "params" => array(
                "page" => '$1||1'
            )
        ),
        "result" => array(
            "path" => '/result/(\d+)',
            "controller" => "parser",
            "action" => "item",
            "params" => array(
                "id" => '$1'
            )
        ),
        "404" => array(
            "controller" => "errors",
            "action" => "404"
        ),
        "error" => array(
            "controller" => "errors",
            "action" => "error"
        )
    ),
    'controllers' => array(
        "parser" => 'Parser\Controller\ParserController',
        "errors" => 'Core\Controller\ErrorController'
    )
);