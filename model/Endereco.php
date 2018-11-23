<?php

abstract class Endereco{
	private $id_endereco;
	private $cep;
	private $bairro;
	private $rua;
	private $ponto_de_referencia;

	public function __construct($cep,$bairro,$rua,$ponto_de_referencia)
    {
        $this->cep=$cep;
        $this->bairro=$bairro;
        $this->rua=$rua;
        $this->ponto_de_referencia=$ponto_de_referencia;
    }

    public function getId(){
		return $this->id_endereco;
	}
	public function setId($id_endereco){
		$this->id_endereco = $id_endereco;
	}

	public function getCep(){
		return $this->cep;
	}
	public function setCep($cep){
		$this->cep = $cep;
	}

	public function getBairro(){
		return $this->bairro;
	}
	public function setBairro($bairro){
		$this->bairro = $bairro;
	}

	public function getRua(){
		return $this->rua;
	}
	public function setRua($rua){
		$this->rua = $rua;
	}

	public function getPonto_de_referencia(){
		return $this->ponto_de_referencia;
	}
	public function setPonto_de_referencia($ponto_de_referencia){
		$this->ponto_de_referencia = $ponto_de_referencia;
	}

}
