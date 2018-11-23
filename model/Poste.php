<?php
require_once 'Endereco.php';

class Poste extends Endereco{
	private $foto;
	private $numeracao;

	public function getFoto()
    {
		return $this->foto;
	}
	public function setFoto($foto)
    {
		$this->foto = $foto;
	}

	public function getNumeracao(){
        
		return $this->numeracao;
	}
	public function setNumeracao($numeracao)
    {
		$this->numeracao = $numeracao;
	}
}
