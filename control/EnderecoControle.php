<?php

include_once '../model/Endereco.php';

class EnderecoControle
{
	public function verificar(){
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
			$produtoDAO->incluir($endereco);

			session_start();

            header("Location: ../html/sucesso.php");
        } catch (PDOException $e){
            $msg= "Não foi possível registrar o endereço"."<br>".$e->getMessage();
            echo $msg;
        }
	}

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
		} catch
	}
	session_start();
        $descricao = $_REQUEST['descricao'];
        try {
            $produtoDao = new ProdutoDAO();
            $produto = $produtoDao->listarUm($descricao);
            $_SESSION['produto']= $produto;
            header('Location: '.$_REQUEST['nextPage']);
        } catch (Exception $e) {
            $msg = "Não foi possível listar o produto!";
            header('Location: ../html/msg.php?msg='.$msg);
        }   
        
    }
}