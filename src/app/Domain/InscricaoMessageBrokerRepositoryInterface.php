<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Domain;

/**
 * InscricaoMessageBrokerRepositoryInterface interface
 *
 * Serviço de mensageria da Inscricao - RabbitMQ
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
interface InscricaoMessageBrokerRepositoryInterface
{
    public function publisher(Array $payload);
}