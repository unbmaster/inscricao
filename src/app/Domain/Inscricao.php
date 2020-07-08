<?php
/*
 * This file is part of the https://github.com/unbmaster
 * For demonstration purposes, use it at your own risk.
 * (c) UnBMaster <unbmaster@outlook.com>
 * License GNU General Public License (GPL)
 */

namespace Domain;

/**
 * Inscricao class (Entity)
 *
 * @author UnBMaster <unbmaster@outlook.com>
 * @version 0.1.0
 */
class Inscricao
{
    private $inscricaoId;
    private $militarId;
    private $planoId;
    private $status;
    private $criadoEm;

    function __construct()
    {
        $this->criadoEm   = date('Y-m-d H:i:s');
    }

    /**
     * @return int
     */
    public function getInscricaoId(): int
    {
        return $this->inscricaoId;
    }

    /**
     * @param int $inscricaoId
     */
    public function setInscricaoId(int $inscricaoId): void
    {
        $this->inscricaoId = $inscricaoId;
    }

    /**
     * @return MilitarId
     */
    public function getMilitarId(): MilitarId
    {
        return $this->militarId;
    }

    /**
     * @param MilitarId $militarId
     */
    public function setMilitarId(MilitarId $militarId): void
    {
        $this->militarId = $militarId;
    }

    /**
     * @return int
     */
    public function getPlanoId(): int
    {
        return $this->planoId;
    }

    /**
     * @param int $planoId
     */
    public function setPlanoId(int $planoId): void
    {
        $this->planoId = $planoId;
    }

    /**
     * @return false|string
     */
    public function getCriadoEm()
    {
        return $this->criadoEm;
    }

    /**
     * @param false|string $criadoEm
     */
    public function setCriadoEm($criadoEm): void
    {
        $this->criadoEm = $criadoEm;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }



}