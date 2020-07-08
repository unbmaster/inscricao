<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Domain;

/**
 * InscricaoRepositoryInterface interface
 *
 * Manipula dados do Inscricao - SQLite
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
interface InscricaoRepositoryInterface
{
    public function add(Inscricao $inscricao);
    public function getById(Inscricao $militarId);
}