<?php
include_once '../model/Endereco.php';
include_once '../dao/Conexao.php';

class EnderecoDAO
{
        
        public function adicionar($endereco)
        {
            try {
                $pdo = Conexao::connect();
                $sql = 'INSERT endereco(cep, bairro, rua, referencia) VALUES(:cep, :bairro, :rua, :referencia)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':cep' => $endereco->getCep(),
                    ':bairro' => $endereco->getBairro(),
                    ':rua' => $endereco->getRua(),
                    ':referencia' => $endereco->getReferencia(),
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        
        public function alterar($endereco)
        {
            try {
                $pdo = Conexao::connect();
                ;
                $sql = 'UPDATE endereco SET cep=:cep, bairro=:bairro, rua=:rua, referencia=:referencia where id=:id';
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute(array(
                    ':id' => $endereco->getId(),
                    ':cep' => $endereco->getCep(),
                    ':bairro' => $endereco->getBairro(),
                    ':rua' => $endereco->getRua(),
                    ':referencia' => $endereco->getReferencia(),
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        
        public function excluir($id)
        {
            try {
                $pdo = Conexao::connect();
                $stmt = $pdo->prepare('DELETE from endereco where id= :id');
                $stmt->execute(array(
                    ':id' => $id
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        
        public function listar($nome)
        {
            $nome = "%" . $nome . "%";
            try {
                $pdo = Conexao::connect();
                $sql = "SELECT id,cep, bairro, rua, referencia FROM poste where nome like :nome";
                $consulta = $pdo->prepare($sql);
                $consulta->execute(array(
                    ':nome' => $nome
                ));
                $enderecos = Array();
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $endereco = new Poste($linha['nome'], $linha['cep'], $linha['bairro'], $linha['rua'], $linha['referencia']);
                    $endereco->setId($linha['id_endereco']);
                    $enderecos[] = $endereco;
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return $enderecos;
        }
        

}