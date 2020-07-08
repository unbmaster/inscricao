<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Controller;
use Core\JWT;

/**
 * InscricaoController class
 *
 * Orquestra e trata requisições
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class InscricaoController
{

    /**
     * Lista as inscrições do militar
     *
     * @param $request
     * @param $response
     * @return mixed
     */
    public function listar($request, $response)
    {
        $input         = $request->getParsedBody();
        $token         = JWT::getTokenFromHeader($request);
        $correlationId = JWT::getCorrelationIdFromHeader($request);
        $payload       = JWT::getPayloadFromToken($token);

        $params = [
            'militarId'     => $request->getAttribute('id'),
            'nome'          => $payload['name'],
            'posto'         => $payload['rank'],
            'email'         => $payload['email'],
            'permissoes'    => $payload['roles'],
            'token'         => $token,
            'correlationId' => $correlationId,
        ];

        $inscricoes = (new \Application\ObterInscricoes)($params);
        $inscricoes = json_encode($inscricoes, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        $response->getBody()->write($inscricoes);
        return $response;
    }

    /**
     * Realiza a inscrição do militar em um plano (curso/estágio)
     *
     * @param $request
     * @param $response
     * @return mixed
     */
    public function inscrever($request, $response)
    {
        $input   = $request->getParsedBody();
        $input   = filter_var_array($input,FILTER_SANITIZE_STRING);
        $token   = JWT::getTokenFromHeader($request);
        $payload = JWT::getPayloadFromToken($token);

        $params = [
            'militarId'  => $payload['sub'],
            'nome'       => $payload['name'],
            'posto'      => $payload['rank'],
            'email'      => $payload['email'],
            'permissoes' => $payload['roles'],
            'planoId'    => $input['planoSelecionado'],
            'token'      => $token
        ];

        $dados = (new \Application\RealizaInscricao)($params);
        $status = (isset($dados['inscricao']['inscricaoId'])) ? 201 : 202;
        $dados = json_encode($dados, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        $response->getBody()->write($dados);
        return $response->withStatus($status);
    }
}