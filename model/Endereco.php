<?php

class Endereco
{
    private $cep;
    private $bairro;
    private $rua;
    private $ponto_de_referencia;
    public function getCep()
    {
        return $this->cep;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function getPonto_de_referencia()
    {
        return $this->ponto_de_referencia;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    public function setPonto_de_referencia($ponto_de_referencia)
    {
        $this->ponto_de_referencia = $ponto_de_referencia;
    }

    
}