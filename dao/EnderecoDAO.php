<?php
include_once '../model/Endereco.php';
include_once '../dao/Conexao.php';

class EnderecoDAO
{
        
        public function adicionar($endereco)
        {
            try {
                $pdo = Conexao::connect();
                $sql = 'INSERT Endereco(cep, bairro, rua, referencia) VALUES(:cep, :bairro, :rua, :referencia)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':cep' => $endereco->getCep(),
                    ':bairro' => $endereco->getBairro(),
                    ':rua' => $endereco->getRua(),
                    ':referencia' => $endereco->getPonto_de_referencia(),
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }

        public function listarTodos(){

            try{
                $endereco = array();
                $pdo = Conexao::connect();
                $consulta = $pdo->query("SELECT id_endereco, cep, bairro, rua, referencia FROM Endereco");
                $x = 0;
                while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                    $endereco[$x] = array('id_endereco'=>$linha['id_endereco'], 'cep'=>$linha['cep'], 'bairro'=>$linha['bairro'], 'rua'=>$linha['rua'], 'referencia'=>$linha['referencia']);
                    $x++;
                }
            } catch (PDOExeption $e){
                    echo 'Error:' . $e->getMessage;
                }
                return json_encode($endereco);
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
                    ':referencia' => $endereco->getPonto_de_referencia(),
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        
        public function excluir($id_endereco)
        {
            try {
                $pdo = Conexao::connect();
                $stmt = $pdo->prepare('DELETE FROM Endereco WHERE id_endereco = :id_endereco');
                $stmt->execute(array(
                    ':id_endereco' => $id_endereco
                ));
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        
        public function listarporCEP($cep)
        {
            $cep = "%" . $cep . "%";
            try {
                $pdo = Conexao::connect();
                $sql = "SELECT id_endereco,cep, bairro, rua, referencia FROM Endereco where cep like :cep";
                $consulta = $pdo->prepare($sql);
                $consulta->execute(array(
                    ':cep' => $cep
                ));
                $enderecos = Array();
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $endereco = new Endereco($linha['cep'], $linha['bairro'], $linha['rua'], $linha['referencia']);
                    $endereco->setId($linha['id_endereco']);
                    $enderecos[] = $endereco;
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            return json_encode($enderecos);
        }
        

}