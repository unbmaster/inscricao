<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Domain;

use Core\{Config, RemoteAPI};
use Infrastructure\{InscricaoRepository, InscricaoMessageBrokerRepository};

/**
 * InscricaoService class
 *
 * Manipula Planos
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class InscricaoService
{
    /**
     * ObterInscricoes Method
     *
     * Retorna as inscrições de um militar
     * @return bool|array
     */
    public function ObterInscricoes($params)
    {
        try {

            # Tenta recuperar as incrições do militar
            $repositorio = new InscricaoRepository;
            $inscricoes = $repositorio->getById($params['militarId']);

            # Caso não tenha inscrições
            if (!$inscricoes) return [
                'usuario' => [
                    'militarId' => $params['militarId'],
                    'posto'     => $params['posto'],
                    'nome'      => $params['nome'],
                    'email'     => $params['email']
                ],
                'inscricoes'    => []
            ];



            # Recupera os ids das inscrições
            $planoIds = array_column($inscricoes, 'planoId');

            # Cria url do serviço remoto (planos)
            $serviceURL = '/planos?id=' . implode(',', $planoIds);

            # Chama serviço remoto para obter dados do plano
            $planos = RemoteAPI::callByGet(
                $serviceURL,
                $params['token'],
                $params['correlationId']
            );

            # Lança exceção caso não haja dados remoto
            if (!$planos) throw new \Exception();

            # Prepara os dados da inscrição
            $planos = json_decode($planos, true);
            foreach ($inscricoes as &$inscricao) {
                foreach ($planos as $plano) {
                    if ($inscricao['planoId'] === $plano['planoId']) {
                        unset($inscricao['militarId']);
                        $inscricao['titulo'] = $plano['titulo'];
                    }
                }
            }

            # Prepara dados de resposta
            return [
                'usuario' => [
                    'militarId' => $params['militarId'],
                    'posto'     => $params['posto'],
                    'nome'      => $params['nome'],
                    'email'     => $params['email']
                ],
                'inscricoes'    => $inscricoes
            ];

        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * RealizarInscricao Method
     *
     * Efetiva a inscrição do militar em um plano (curso e estágio)
     * @return bool|array
     */
    public function RealizarInscricao($params)
    {
        try {
            # Cria objeto inscrição
            $inscricao = new Inscricao;
            $inscricao->setMilitarId(new MilitarId($params['militarId']));
            $inscricao->setPlanoId($params['planoId']);

            # Grava inscrição no banco de dados local (SQLite)
            $repositorio = new InscricaoRepository;
            $inscricao = $repositorio->add($inscricao);

            # Envia inscrição para fila de processamento
            if ($inscricao) {
                $broker = new InscricaoMessageBrokerRepository;
                $inscricaoId = $inscricao->getInscricaoId();
                $payload = [
                    'inscricaoId' => $inscricaoId,
                    'militarId'   => $params['militarId'],
                    'planoId'     => $params['planoId'],
                    'nome'        => $params['nome'],
                    'posto'       => $params['posto'],
                    'email'       => $params['email'],
                    'permissoes'  => $params['permissoes'],
                    'token'       => $params['token']
                ];
                $broker->publisher($payload);
                return [
                    'inscricao' => [
                        'inscricaoId' => $inscricaoId,
                        'militarId'   => $params['militarId'],
                        'planoId'     => $params['planoId']
                    ],
                    'mensagem' => "Inscrição {$inscricaoId} está em processamento"
                ];
            }
            else {
                return [
                    'inscricao' => [
                        'militarId'   => $params['militarId'],
                        'planoId'     => $params['planoId']
                    ],
                    'mensagem' => "Inscrição no plano {$params['planoId']} já existe"
                ];
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}