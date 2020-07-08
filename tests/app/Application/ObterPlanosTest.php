<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Application\Tests;

use Application\ObterPlanos;
use PHPUnit\Framework\TestCase;

/**
 * ObterPlanosTest class
 *
 * Testa Caso de Uso: Obter planos do militar
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class ObterPlanosTest extends TestCase
{

    public function testObterPlanosDoMilitar() {
        $planos = new ObterPlanos();
        $data  = $planos([]);
        self::assertArrayHasKey('planoId', $data[0]);
        self::assertNotEmpty($data[0]['planoId']);
    }

}