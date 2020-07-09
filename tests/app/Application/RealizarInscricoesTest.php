<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Application\Tests;

use Application\RealizaInscricao;
use PHPUnit\Framework\TestCase;

/**
 * ObterInscricoes class
 *
 * Testa Caso de Uso: Obter inscrições do militar
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class RealizarInscricoesTest extends TestCase
{

    public function testRealizarInscricaoDoMilitar() {

        $params = [
            'militarId'         => '1234567890',
            'planoId'           => 1,
            'nome'              => 'Fulano',
            'posto'             => '2 Ten',
            'email'             => 'fulano@mail.com',
            'permissoes'        => ['ROLE_USER'],
            'token'             => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiaXNzIjoibG9naW4iLCJleHAiOjU3MzkxMzY4OTg0MDAsIm5hbWUiOiJGdWxhbm8iLCJyYW5rIjoiMlx1MDBiYSBUZW4iLCJlbWFpbCI6ImZ1bGFub0BtYWlsLmNvbSIsInJvbGVzIjpbIlJPTEVfVVNFUiIsIlJPTEVfQURNSU4iXX0.2DYmpCSANAP5gCZ4epasVXWCvb2pOjwahCsn2BoiHCQ',
            'x-correlation-id'  => 'e977ac8e-32ad-46c7-9803-1bb60cb63cad'
        ];

        $inscricao = new RealizaInscricao();
        $data  = $inscricao($params);

        self::assertArrayHasKey('inscricao', $data);
        self::assertNotEmpty($data['inscricao']);
    }

}