<?php

class Endereco{
	private $cep;
	private $bairro;
	private $rua;
	private $ponto_de_referencia;

	public function getCep(){
		return $this->cep;
	}
	public function setCep($cep){
		$this->cep = $cep;
	}

	public function getBairro(){
		return $this->bairro;
	}
	public function setCep($bairro){
		$this->bairro = $bairro;
	}

	public function getRua(){
		return $this->rua;
	}
	public function setCep($rua){
		$this->rua = $cep;
	}

	public function getPonto_de_referencia(){
		return $this->ponto_de_referencia;
	}
	public function setCep($ptr){
		$this->ponto_de_referencia = $pdr;
	}
}
