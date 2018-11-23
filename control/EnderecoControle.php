<?php

require_once '../model/Endereco.php';
require_once '../dao/EnderecoDAO';

class EnderecoControle
{
	/*public function verificar(){
		extract($_REQUEST);
		if(!isset($cep) || empty($cep)){
			$msg = "CEP do endereço não informado. Por favor, informe um CEP!";
			header('Location: ../view/entrada.php?msg='.$msg);
		}
		else if(!isset($bairro) || empty($bairro)){
			$msg = "Bairro do endereço não informado. Por favor, informe um bairro!";
			header('Location: ../view/entrada.php?msg='.$msg);
		}
		else if(!isset($rua) || empty($rua)){
			$msg = "Rua do endereço não informado. Por favor, informe uma rua!";
			header('Location: ../view/entrada.php?msg='.$msg);
		}
		else if(!isset($ponto_de_referencia) || empty($ponto_de_referencia)){
			$msg = "Ponto de referência não informado. Por favor, informe um ponto de referência!";
			header('Location: ../view/entrada.php?msg='.$msg);
		}
		else{
			$endereco = new Endereco($cep, $bairro, $rua, $ponto_de_referencia);

			return $endereco;
		}
	}

	public function incluir(){
		$endereco = $this->verificar();
		extract($_REQUEST);
		$enderecoDAO = new EnderecoDAO();

		try{
			$produtoDAO->adicionar($endereco);

			session_start();

            header("Location: ../html/sucesso.php");
        } catch (PDOException $e){
            $msg= "Não foi possível registrar o endereço"."<br>".$e->getMessage();
            echo $msg;
        }
	}*/

	public function listarTodos(){
		extract($_REQUEST);
		$enderecoDAO = new EnderecoDAO();
		$endereco = $enderecoDAO->listarTodos();
		$_SESSION['endereco'] = $endereco;
		header('Location: '.$nextPage);
	}

	public function listarporCEP($cep){
		session_start();
		$cep = $_REQUEST['cep'];
		try{
			$enderecoDAO = new EnderecoDAO();
			$endereco= $enderecoDAO->listarporCEP($cep);
			$_SESSION['endereco'] = $endereço;
			header('Location: '.$_REQUEST['nextPage']);
		} catch (Exception $e) {
            $msg = "Não foi possível listar o endereço";
            header('Location: ../view/msg.php?msg='.$msg);
        }   
	}

	public function excluir($id_endereco){
		$endereco = new Endereco(null,null,null,null);
		$endereco->setId($_REQUEST['id']);

		try{
			$enderecoDAO = new EnderecoDAO();
			$enderecoDAO->excluir($endereco);
			$msg = "O endereco foi excluido com sucesso!";
			header('Location: '.$nextPage);
		} catch (PDOException $e) {
            $msg = "Não foi possível excluir, tente novamente!";
        }
        header('Location: ../html/msg.php?msg=' . $msg);
	}   
        
}