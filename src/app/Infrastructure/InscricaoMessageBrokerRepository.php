<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Infrastructure;

use Domain\{InscricaoMessageBrokerRepositoryInterface, Inscricao};
use Core\{MessageBroker, Convert};

/**
 * InscricaoMessageBrokerRepository Class
 *
 * Serviço de mensageria da Inscricao - RabbitMQ
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class InscricaoMessageBrokerRepository implements InscricaoMessageBrokerRepositoryInterface
{
    /**
     * Adiciona a inscrição do militar/plano numa fila para processamento
     * @param array $payload
     * @return void
     * @throws \Exception
     */
    public function publisher(Array $payload) {
        MessageBroker::publish('canalInscricaoRealizada', $payload);
    }
}