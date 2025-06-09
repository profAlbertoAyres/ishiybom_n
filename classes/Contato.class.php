<?php

class Contato extends CRUD
{
    protected $table = "contato";
    private $idContato;
    private $idEmpresa;
    private $tipoContato;
    private $informacaoContato;
    private $rodapeContato;
    private $ordemRodapeContato;

    public function setIdContato($idContato)
    {
        $this->idContato = $idContato;
    }

    public function getIdContato()
    {
        return $this->idContato;
    }

    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function setTipoContato($tipoContato)
    {
        $this->tipoContato = $tipoContato;
    }

    public function getTipoContato()
    {
        return $this->tipoContato;
    }

    public function setInformacaoContato($informacaoContato)
    {
        $this->informacaoContato = $informacaoContato;
    }

    public function getInformacaoContato()
    {
        return $this->informacaoContato;
    }

    public function setRodapeContato($rodapeContato)
    {
        $this->rodapeContato = $rodapeContato;
    }

    public function getRodapeContato()
    {
        return $this->rodapeContato;
    }

    public function setOrdemRodapeContato($ordemRodapeContato)
    {
        $this->ordemRodapeContato = $ordemRodapeContato;
    }

    public function getOrdemRodapeContato()
    {
        return $this->ordemRodapeContato;
    }

    public function add()
    {
        // SQL de inserção
        $sql = "INSERT INTO $this->table (idempresa, tipocontato, informacaocontato, rodapecontato, odermrodapecontato) 
         VALUES (:idempresa, :tipocontato, :informacaocontato, :rodapecontato, :odermrodapecontato)";
        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':idempresa', $this->idEmpresa);
        $stmt->bindParam(':tipocontato', $this->tipoContato);
        $stmt->bindParam(':informacaocontato', $this->informacaoContato);
        $stmt->bindParam(':rodapecontato', $this->rodapeContato);
        $stmt->bindParam(':odermrodapecontato', $this->ordemRodapeContato);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }
    public function update(string $campo, int $id)
    {
        $sql = "UPDATE $this->table SET idempresa=:idempresa, tipocontato= :tipocontato, informacaocontato=:informacaocontato, rodapecontato=:rodapecontato, odermrodapecontato=:odermrodapecontato WHERE $campo=:id";
        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':idempresa', $this->idEmpresa);
        $stmt->bindParam(':tipocontato', $this->tipoContato);
        $stmt->bindParam(':informacaocontato', $this->informacaoContato);
        $stmt->bindParam(':rodapecontato', $this->rodapeContato);
        $stmt->bindParam(':odermrodapecontato', $this->ordemRodapeContato);
        $stmt->bindParam(':id', $id);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }

    public function allContato(int $id, string $tipo = "")
    {
        $sql = "SELECT * FROM  $this->table WHERE idEmpresa = :idEmp and tipocontato like '%{$tipo}' order by tipocontato ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idEmp', $id, PDO::PARAM_INT);
        // Executar a consulta e verificar se funcionou
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function exibirRodape(int $id)
    {
        $sql = "SELECT * FROM  $this->table WHERE idEmpresa = :idEmp and rodapecontato like 'Sim' order by odermrodapecontato ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idEmp', $id, PDO::PARAM_INT);
        // Executar a consulta e verificar se funcionou
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}