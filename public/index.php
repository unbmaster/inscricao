<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

/**
 * Ponto central das requisições e rotas de acesso aos serviços
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */

ini_set('display_errors', true);

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$auth = new Core\IdentificacaoMiddleware;

$app->add(new Core\CorrelationIdMiddleware);

$app->post('/inscricoes', 'Controller\InscricaoController:inscrever')->add($auth);;

$app->get('/inscricoes/militares/{id}', 'Controller\InscricaoController:listar')->add($auth);;

$app->any( '/inscricao', 'Controller\HomeController:api');

$app->run();