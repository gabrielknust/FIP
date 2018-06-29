<?php

class Poste
{
    private $foto;
    private $numeracao;
    
    public function getFoto()
    {
        return $this->foto;
    }

    public function getNumeracao()
    {
        return $this->numeracao;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setNumeracao($numeracao)
    {
        $this->numeracao = $numeracao;
    }
  
}