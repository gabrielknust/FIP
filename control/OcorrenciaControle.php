<?php

require_once '../model/Ocorrencia.php';
require_once '../dao/OcorrenciaDAO.php';
include_once '../dao/Conexao.php';

class OcorrenciaControle
{
	public function verificar(){

		
		extract($_REQUEST);
		if(!isset($cep) || empty($cep)){
			$msg = "CEP do endereço não informado. Por favor, informe um CEP!";
			header('Location: ../view/index.php?msg='.$msg);
		}
		else if(!isset($bairro) || empty($bairro)){
			$msg = "Bairro do endereço não informado. Por favor, informe um bairro!";
			header('Location: ../view/index.php?msg='.$msg);
		}
		else if(!isset($rua) || empty($rua)){
			$msg = "Rua do endereço não informado. Por favor, informe uma rua!";
			header('Location: ../view/index.php?msg='.$msg);
		}
		else if(!isset($ponto_de_referencia) || empty($ponto_de_referencia)){
			$msg = "Ponto de referência não informado. Por favor, informe um ponto de referência!";
			header('Location: ../view/index.php?msg='.$msg);
		}
		else if(!isset($foto) || empty($foto)){
			$foto = "Não informada";
		}
		else if(!isset($numeracao) || empty($numeracao)){
			$numeracao = "Não informada";
		}
		else if(!isset($classificaUrgencia) || empty($classificaUrgencia)){
			$msg = "Classificação da urgência não informada. Por favor, classifique a urgência da ocorrência!";
			header('Location: ../view/index.php?msg='.$msg);
		}
		else if(!isset($descricaoUrgencia) || empty($descricaoUrgencia)){
			$msg = "Descrição da urgência não informada. Por favor, informe uma descrição para urgência";
			header('Location: ../view/index.php?msg='.$msg);
		}
			if(!empty($_FILES['foto']['tmp_name']))
				{
					$imagem=base64_encode(file_get_contents($_FILES['foto']['tmp_name']));
				}
				else{
					$foto='null';
				}
			$ocorrencia = new Ocorrencia($cep, $bairro, $rua, $ponto_de_referencia);
			$ocorrencia->setFoto($foto);
			$ocorrencia->setNumeracao($numeracao);
			$ocorrencia->setClassificaUrgencia($classificaUrgencia);
			$ocorrencia->setDescricaoUrgencia($descricaoUrgencia);
			return $ocorrencia;
		}

	public function incluir(){
		$ocorrencia = $this->verificar();
		$ocoDAO = new OcorrenciaDAO();
		try{
			$ocoDAO->incluir($ocorrencia);
			$msg="Ocorrência cadastrada com sucesso!";
			header('Location: ../view/index.php?msg='.$msg);
		} catch (PDOException $e){
            $msg= "Não foi possível registrar o interno"."<br>".$e->getMessage();
            echo $msg;
        }
	}

	public function listarTodos(){
        extract($_REQUEST);
        $ocorrenciaDAO= new InternoDAO();
        $ocorrencias = $ocorrenciaDAO->listarTodos();
        session_start();
        $_SESSION['ocorrencia']=$ocorrencias;
        header('Location: '.$nextPage);
    }

    public function excluir($id_ocorrencia){

    }

    public function listarUm($id){

    }

}