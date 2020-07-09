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

        $db = new \SQLite3('/db/inscricao.db');
        $db->busyTimeout(5000);
        $statement = $db->prepare('SELECT * FROM inscricao where militarId=?');
        $statement->bindValue(1, $militarId);
        $res = $statement->execute();

        $inscricoes = [];
        while ($row = $res->fetchArray()) {
            $inscricoes[] = [
                'inscricaoId' => $row['inscricaoId'],
                'militarId' => $row['militarId'],
                'planoId' => $row['planoId'],
                'status' => $row['status'],
                'InscritoEm' => $row['criadoEm']
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

        $db = new \SQLite3('/db/inscricao.db');
        $db->busyTimeout(5000);
        #$db->exec('PRAGMA journal_mode = wal;');

        $militarId   = $inscricao->getMilitarId();
        $planoId     = $inscricao->getPlanoId();
        $inscricaoId = $db->querySingle("SELECT inscricaoId FROM inscricao WHERE militarId='{$militarId}' AND planoId='$planoId'");

        # Adiciona o militar no plano caso já não esteja inscrito
        if(!$inscricaoId) {
            $statement = $db->prepare("INSERT INTO inscricao VALUES(null,?,?,?,?)");
            $statement->bindValue(1, $inscricao->getMilitarId());
            $statement->bindValue(2, $inscricao->getPlanoId());
            $statement->bindValue(3, 0);
            $statement->bindValue(4, $inscricao->getCriadoEm());
            $statement->execute();

            # Recupera o inscricaoId cadastrado
            $inscricaoId = $db->querySingle('SELECT last_insert_rowid()');
            $inscricao->setInscricaoId($inscricaoId);

            return $inscricao;
        }

        $db->close();
        unset($db);

        return false;
    }
}