<?php
include_once '../model/Poste.php';
include_once '../dao/Conexao.php';

class PosteDAO
{
    
    public function adicionar($poste)
    {
        try {
            $pdo = Conexao::connect();
            $sql = 'INSERT Poste(foto, numeracao) VALUES(:foto, :numeracao)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':foto' => $poste->getFoto(),
                ':numeracao' => $poste->getNumeracao()
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function alterar($poste)
    {
        try {
            $pdo = Conexao::connect();
            ;
            $sql = 'UPDATE poste SET foto=:foto, numeracao=:numeracao where id=:id';
            $stmt = $pdo->prepare($sql);
            
            $stmt->execute(array(
                ':foto' => $poste->getFoto(),
                ':numeracao' => $poste->getNumeracao()
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function excluir($id)
    {
        try {
            $pdo = Conexao::connect();
            $stmt = $pdo->prepare('DELETE from poste where id= :id');
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
            $sql = "SELECT foto,numeracao FROM poste where nome like :nome";
            $consulta = $pdo->prepare($sql);
            $consulta->execute(array(
                ':nome' => $nome
            ));
            $postes = Array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $poste = new Poste($linha['foto'], $linha['numeracao']);
                $poste->setId($linha['id_poste']);
                $postes[] = $poste;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $postes;
    }
    
    
}