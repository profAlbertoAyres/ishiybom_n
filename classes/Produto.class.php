<?php
  
class Produto extends CRUD{
    protected $table = "produto";
    private $idProduto;
    private $nomeProduto;
    private $descricaoProduto;
    private $categoriaProduto;
    private $ativoProduto;


    public function add(){
        // SQL de inserção
        $sql = "INSERT INTO $this->table (nomeproduto, descricaoproduto, categoriaproduto) 
                VALUES (:nomeproduto, :descricaoproduto, :categoriaproduto)";

        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeproduto', $this->nomeProduto);
        $stmt->bindParam(':descricaoproduto', $this->descricaoProduto);
        $stmt->bindParam(':categoriaproduto', $this->categoriaProduto);


        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    public function update($campo, $id){
        $sql = "UPDATE $this->table SET nomeproduto = :nomeproduto, descricaoproduto = :descricaoproduto, categoriaproduto=:categoriaproduto WHERE $campo=:id";
        $stmt = $this->db->prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeproduto', $this->nomeProduto);
        $stmt->bindParam(':descricaoproduto', $this->descricaoProduto);
        $stmt->bindParam(':categoriaproduto', $this->categoriaProduto);;
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }

    public function produtoFiltro(string $campo, int $id){
        $sql = "SELECT p.* FROM  $this->table p where $campo = :id;" ;
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        // Executar a consulta e verificar se funcionou
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Get the value of idProduto
     */ 
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set the value of idProduto
     *
     * @return  self
     */ 
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;

        return $this;
    }

    /**
     * Get the value of nomeProduto
     */ 
    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    /**
     * Set the value of nomeProduto
     *
     * @return  self
     */ 
    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;

        return $this;
    }

    /**
     * Get the value of descricaoProduto
     */ 
    public function getDescricaoProduto()
    {
        return $this->descricaoProduto;
    }

    /**
     * Set the value of descricaoProduto
     *
     * @return  self
     */ 
    public function setDescricaoProduto($descricaoProduto)
    {
        $this->descricaoProduto = $descricaoProduto;

        return $this;
    }

    /**
     * Get the value of categoriaProduto
     */ 
    public function getCategoriaProduto()
    {
        return $this->categoriaProduto;
    }

    /**
     * Set the value of categoriaProduto
     *
     * @return  self
     */ 
    public function setCategoriaProduto($categoriaProduto)
    {
        $this->categoriaProduto = $categoriaProduto;

        return $this;
    }


    /**
     * Get the value of ativoProduto
     */ 
    public function getAtivoProduto()
    {
        return $this->ativoProduto;
    }

    /**
     * Set the value of ativoProduto
     *
     * @return  self
     */ 
    public function setAtivoProduto($ativoProduto)
    {
        $this->ativoProduto = $ativoProduto;

        return $this;
    }
}