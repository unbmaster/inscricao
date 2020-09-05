<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Infrastructure;

use Domain\{InscricaoRepositoryInterface, Inscricao, Usuario};

/**
 * PlanoRepository Class
 *
 * Manipula dados da inscrição via SQLite
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class InscricaoRepository implements InscricaoRepositoryInterface
{

    /**
     * Retorna as inscrições (cursos e estágios) do militar
     * @return array
     */
    public function getById($militarId) {
        $db=pg_connect ("host=db dbname=unbmaster port=5432 user=postgres password=example");
        $result =   pg_query_params($db,'SELECT * FROM inscricao where militarId = $1', [$militarId]);
        $inscricoes = [];
        while ($row = pg_fetch_array($result)) {
            $inscricoes[] = [
                'inscricaoId' => $row['inscricaoid'],
                'militarId' => $row['militarid'],
                'planoId' => $row['planoid'],
                'status' => $row['status'],
                'InscritoEm' => $row['criadoem']
            ];
        }
        return $inscricoes;
    }


    /**
     * Adiciona o militar a um plano (cursos e estágios)
     * @param Inscricao $inscricao
     * @return bool|Inscricao
     */
    public function add(Inscricao $inscricao) {

        $militarId   = $inscricao->getMilitarId();
        $planoId     = $inscricao->getPlanoId();

        $db=pg_connect ("host=db dbname=unbmaster port=5432 user=postgres password=example");
        $result = pg_query($db, "SELECT inscricaoId FROM inscricao WHERE militarId='{$militarId}' AND planoId='$planoId'");
        $dbdata = pg_fetch_array($result);
        $inscricaoId = $dbdata['inscricaoid'];

        # Adiciona o militar no plano caso já não esteja inscrito
        if(!$inscricaoId) {
            $result =   pg_query_params($db,"INSERT INTO inscricao (militarid,planoid,status,criadoem) VALUES($1,$2,$3,$4) RETURNING inscricaoid", [
                            $inscricao->getMilitarId(),
                            $inscricao->getPlanoId(),
                            0,
                            $inscricao->getCriadoEm()
                        ]);

            # Recupera o inscricaoId cadastrado
            $dbdata = pg_fetch_array($result);
            $inscricao->setInscricaoId($dbdata['inscricaoid']);
            return $inscricao;
        }
        unset($db);
        return false;
    }
}