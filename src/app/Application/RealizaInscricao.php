<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Application;

use Domain\{InscricaoService, Usuario};

/**
 * ObterPlanos class
 *
 * Realiza Caso de Uso: Obter Planos
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class RealizaInscricao
{
    public function __invoke($params) {

        # Inscrever o militar em um determinado plano (curso/estágio)
        $service  = new InscricaoService;
        $dados = $service->realizarInscricao($params);
        return $dados;
    }
}