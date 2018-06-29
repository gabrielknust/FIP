<?php
include_once '../model/Ocorrencia.php';
include_once '../dao/Conexao.php';

class OcorrenciaDAO
{
    
    public function adicionar($ocorrencia)
    {
        try {
            $pdo = Conexao::connect();
            $sql = 'INSERT Ocorrencia(classificaUrgencia, descricaoUrgencia) VALUES(:classificaUrgencia, :descricaoUrgencia)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':classificaUrgencia' => $ocorrencia->getClassificaUrgencia(),
                ':descricaoUrgencia' => $ocorrencia->getDescricaoUrgencia()
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function alterar($ocorrencia)
    {
        try {
            $pdo = Conexao::connect();
            ;
            $sql = 'UPDATE Ocorrencia SET classificaUrgencia=:classificaUrgencia, descricaoUrgencia=:descricaoUrgencia where id=:id';
            $stmt = $pdo->prepare($sql);
            
            $stmt->execute(array(
                ':classificaUrgencia' => $ocorrencia->getClassificaUrgencia(),
                ':descricaoUrgencia' => $ocorrencia->getDescricaoUrgencia()
            ));
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function excluir($id)
    {
        try {
            $pdo = Conexao::connect();
            $stmt = $pdo->prepare('DELETE from Ocorrencia where id_ocorrencia= :id_ocorrencia');
            $stmt->execute(array(
                ':id_ocorrencia' => $id_ocorrencia
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
            $sql = "SELECT classificaUrgencia,descricaoUrgencia FROM Ocorrencia where nome like :nome";
            $consulta = $pdo->prepare($sql);
            $consulta->execute(array(
                ':nome' => $nome
            ));
            $ocorrencias = Array();
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $ocorrencia = new Ocorrencia($linha['classificaUrgencia'], $linha['descricaoUrgencia']);
                $ocorrencia->setId($linha['id_Ocorrencia']);
                $ocorrencias[] = $ocorrencia;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $ocorrencias;
    }
    
    
}