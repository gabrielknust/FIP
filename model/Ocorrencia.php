<?php
require_once 'Poste.php';

class Ocorrencia extends Poste
{
    private $classificaUrgencia;
    private $descricaoUrgencia;
    
    public function getClassificaUrgencia()
    {
        return $this->classificaUrgencia;
    }

    public function getDescricaoUrgencia()
    {
        return $this->descricaoUrgencia;
    }

    public function setClassificaUrgencia($classificaUrgencia)
    {
        $this->classificaUrgencia = $classificaUrgencia;
    }

    public function setDescricaoUrgencia($descricaoUrgencia)
    {
        $this->descricaoUrgencia = $descricaoUrgencia;
    }
}