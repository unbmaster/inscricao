<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'phpseclib\\' => array($vendorDir . '/phpseclib/phpseclib/phpseclib'),
    'View\\' => array($baseDir . '/src/app/UI/View'),
    'Test\\' => array($baseDir . '/src/test'),
    'Slim\\Psr7\\' => array($vendorDir . '/slim/psr7/src'),
    'Slim\\' => array($baseDir . '/Slim', $vendorDir . '/slim/slim/Slim'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Psr\\Http\\Server\\' => array($vendorDir . '/psr/http-server-handler/src', $vendorDir . '/psr/http-server-middleware/src'),
    'Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-factory/src', $vendorDir . '/psr/http-message/src'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'Predis\\' => array($vendorDir . '/predis/predis/src'),
    'PhpAmqpLib\\' => array($vendorDir . '/php-amqplib/php-amqplib/PhpAmqpLib'),
    'Nyholm\\Psr7\\' => array($vendorDir . '/nyholm/psr7/src'),
    'Nyholm\\Psr7Server\\' => array($vendorDir . '/nyholm/psr7-server/src'),
    'Laminas\\ZendFrameworkBridge\\' => array($vendorDir . '/laminas/laminas-zendframework-bridge/src'),
    'Laminas\\Diactoros\\' => array($vendorDir . '/laminas/laminas-diactoros/src'),
    'Infrastructure\\' => array($baseDir . '/src/app/Infrastructure'),
    'Http\\Message\\' => array($vendorDir . '/php-http/message-factory/src'),
    'Http\\Factory\\Guzzle\\' => array($vendorDir . '/http-interop/http-factory-guzzle/src'),
    'GuzzleHttp\\Psr7\\' => array($vendorDir . '/guzzlehttp/psr7/src'),
    'Fig\\Http\\Message\\' => array($vendorDir . '/fig/http-message-util/src'),
    'FastRoute\\' => array($vendorDir . '/nikic/fast-route/src'),
    'Faker\\' => array($vendorDir . '/fzaninotto/faker/src/Faker'),
    'Domain\\' => array($baseDir . '/src/app/Domain'),
    'Core\\' => array($baseDir . '/src/core'),
    'Controller\\' => array($baseDir . '/src/app/UI/Controller'),
    'Config\\' => array($baseDir . '/src/config'),
    'Application\\' => array($baseDir . '/src/app/Application'),
);
