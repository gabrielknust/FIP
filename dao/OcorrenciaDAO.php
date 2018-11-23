<?php
include_once '../model/Ocorrencia.php';
include_once '../dao/Conexao.php';
include_once '../model/Poste.php';

class OcorrenciaDAO
{
    
    public function incluir($ocorrencia)
    {        
        try {
            $sql = 'call cadOcorrencia(:cep,:bairro,:rua,:referencia,:foto,:numeracao,:classificaUrgencia,:descricaoUrgencia)';
            $sql = str_replace("'", "\'", $sql);            
            $pdo = Conexao::connect();
            $stmt = $pdo->prepare($sql);

            $cep=$ocorrencia->getCep();
            $bairro=$ocorrencia->getBairro();
            $rua=$ocorrencia->getRua();
            $referencia=$ocorrencia->getPonto_de_referencia();
            $foto=$ocorrencia->getFoto();
            $numeracao=$ocorrencia->getNumeracao();
            $classificaUrgencia=$ocorrencia->getClassificaUrgencia();
            $descricaoUrgencia=$ocorrencia->getDescricaoUrgencia();


            $stmt->bindParam(':cep',$cep);
            $stmt->bindParam(':bairro',$bairro);
            $stmt->bindParam(':rua',$rua);
            $stmt->bindParam(':referencia',$referencia);
            $stmt->bindParam(':foto',$foto);
            $stmt->bindParam(':numeracao',$numeracao);
            $stmt->bindParam(':classificaUrgencia',$classificaUrgencia);
            $stmt->bindParam(':descricaoUrgencia',$descricaoUrgencia);
            $stmt->execute();

        }catch (PDOExeption $e) {
            echo 'Error: <b>  na tabela Ocorrencia = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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
    
    public function excluir($id_endereco, $id_ocorrencia, $id_poste)
    {
        try {
            $pdo = Conexao::connect();
            $sql = "call delOcorrencia(:id_ocorrencia,:id_poste,:id_endereco)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id_ocorrencia',$id_ocorrencia);
            $stmt->bindParam(':id_poste',$id_poste);
            $stmt->bindParam(':id_endereco',$id_endereco);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function listar($id)
    {
        try {
            $pdo = Conexao::connect();
            $sql = "SELECT classificaUrgencia,descricaoUrgencia FROM Ocorrencia where id_ocorrencia=:id";
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
    
    public function listarTodos(){

        try{
            $ocorrencias=array();
            $pdo = Conexao::connect();
            $consulta = $pdo->query("SELECT e.bairro, e.rua, e.referencia, p.numeracao, o.classificaUrgencia, o.descricaoUrgencia FROM Endereco e INNER JOIN Poste p ON e.id_endereco = p.id_endereco INNER JOIN Ocorrencia o on p.id_poste = o.id_poste");
            $produtos = Array();
            $x=0;
            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                $ocorrencias[$x]=array('bairro'=>$linha['bairro'],'rua'=>$linha['rua'],'referencia'=>$linha['referencia'],'numeracao'=>$linha['numeracao'],'classificaUrgencia'=>$linha['classificaUrgencia'],'descricaoUrgencia'=>$linha['descricaoUrgencia']);
                $x++;
            }
            } catch (PDOExeption $e){
                echo 'Error:' . $e->getMessage;
            }
            return json_encode($ocorrencias);
        }
    
}