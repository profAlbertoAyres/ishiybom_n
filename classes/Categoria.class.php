<?php
  
class Categoria extends CRUD{
    protected $table = "Categoria";
    private $idCategoria;
    private $nomeCategoria;



    /**
     * Get the value of nome
     */ 
    public function getNomeCategoria()
    {
        return $this->nomeCategoria;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNomeCategoria($nomeCategoria)
    {
        $this->nomeCategoria = $nomeCategoria;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    

    public function add(){
        // SQL de inserção
        $sql = "INSERT INTO $this->table (nomeCategoria) 
                VALUES (:nomeCategoria)";

        // Preparar a declaração usando a classe Database
        $stmt = Database::prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeCategoria', $this->nomeCategoria);


        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    public function update($campo, $id){
        $sql = "UPDATE $this->table SET nomeCategoria=:nomeCategoria  WHERE $campo=:idCategoria";
        $stmt = Database::prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeCategoria', $this->nomeCategoria);
        $stmt->bindParam(':idCategoria', $id);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }
}