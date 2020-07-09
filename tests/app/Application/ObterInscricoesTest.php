<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Application\Tests;

use Application\ObterInscricoes;
use PHPUnit\Framework\TestCase;

/**
 * ObterInscricoes class
 *
 * Testa Caso de Uso: Obter inscrições do militar
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class ObterInscricoesTest extends TestCase
{

    public function testObterInscricoesDoMilitar() {

        $params = [
            'militarId'         => '1234567890',
            'posto'             => '2 Ten',
            'nome'              => 'Fulano',
            'email'             => 'fulano@mail.com',
            'token'             => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiaXNzIjoibG9naW4iLCJleHAiOjU3MzkxMzY4OTg0MDAsIm5hbWUiOiJGdWxhbm8iLCJyYW5rIjoiMlx1MDBiYSBUZW4iLCJlbWFpbCI6ImZ1bGFub0BtYWlsLmNvbSIsInJvbGVzIjpbIlJPTEVfVVNFUiIsIlJPTEVfQURNSU4iXX0.2DYmpCSANAP5gCZ4epasVXWCvb2pOjwahCsn2BoiHCQ',
            'x-correlation-id'  => 'e977ac8e-32ad-46c7-9803-1bb60cb63cad'
        ];

        $inscricoes = new ObterInscricoes();
        $data  = $inscricoes($params);

        print_r($data[0]);
        self::assertArrayHasKey('inscricoes', $data[0]);
        self::assertNotEmpty($data[0]['inscricoes']);
    }

}