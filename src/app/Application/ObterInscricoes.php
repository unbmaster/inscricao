<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Application;

use Domain\{InscricaoService};

/**
 * ObterInscricoes class
 *
 * Realiza Caso de Uso: Obter Inscrições
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class ObterInscricoes
{
    public function __invoke($params) {

        # Obter as inscrições de um militar
        $service = new InscricaoService();
        return $service->ObterInscricoes($params);
    }
}