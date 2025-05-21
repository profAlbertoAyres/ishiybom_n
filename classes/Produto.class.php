<?php
  
class Produto extends CRUD{
    protected $table = "produto";
    private $idProduto;
    private $nomeProduto;
    private $descricaoProduto;
    private $categoriaProduto;
    private $materialProduto;
    private $alturaProduto;
    private $comprimentoProduto;
    private $larguraProduto;
    private $pesoProduto;
    private $ativoProduto;


    public function add(){
        // SQL de inserção
        $sql = "INSERT INTO $this->table (nomeproduto, descricaoproduto, categoriaproduto, materialproduto, alturaproduto, comprimentoproduto, larguraproduto, pesoproduto) 
                VALUES (:nomeproduto, :descricaoproduto, :categoriaproduto, :materialproduto, :alturaproduto, :comprimentoproduto, :larguraproduto, :pesoproduto)";

        // Preparar a declaração usando a classe Database
        $stmt = Database::prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeproduto', $this->nomeProduto);
        $stmt->bindParam(':descricaoproduto', $this->descricaoProduto);
        $stmt->bindParam(':categoriaproduto', $this->categoriaProduto);
        $stmt->bindParam(':materialproduto', $this->materialProduto);
        $stmt->bindParam(':alturaproduto', $this->alturaProduto);
        $stmt->bindParam(':comprimentoproduto', $this->comprimentoProduto);
        $stmt->bindParam(':larguraproduto', $this->larguraProduto);
        $stmt->bindParam(':pesoproduto', $this->pesoProduto);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    public function update($campo, $id){
        $sql = "UPDATE $this->table SET nomeproduto = :nomeproduto, descricaoproduto = :descricaoproduto, materialproduto = :materialproduto, categoriaproduto=:categoriaproduto, alturaproduto = :alturaproduto, comprimentoproduto = :comprimentoproduto,  larguraproduto = :larguraproduto, pesoproduto = :pesoproduto WHERE $campo=:id";
        $stmt = Database::prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeproduto', $this->nomeProduto);
        $stmt->bindParam(':descricaoproduto', $this->descricaoProduto);
        $stmt->bindParam(':categoriaproduto', $this->categoriaProduto);
        $stmt->bindParam(':materialproduto', $this->materialProduto);
        $stmt->bindParam(':alturaproduto', $this->alturaProduto);
        $stmt->bindParam(':comprimentoproduto', $this->comprimentoProduto);
        $stmt->bindParam(':larguraproduto', $this->larguraProduto);
        $stmt->bindParam(':pesoproduto', $this->pesoProduto);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }

    public function produtoFiltro(string $campo, int $id){
        $sql = "SELECT p.*, m.nomematerial FROM  $this->table p left join material m on p.materialproduto  = m.idmaterial where $campo = :id;" ;
        $stmt = Database::prepare($sql);
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
     * Get the value of materialProduto
     */ 
    public function getMaterialProduto()
    {
        return $this->materialProduto;
    }

    /**
     * Set the value of materialProduto
     *
     * @return  self
     */ 
    public function setMaterialProduto($materialProduto)
    {
        $this->materialProduto = $materialProduto;

        return $this;
    }

    /**
     * Get the value of alturaProduto
     */ 
    public function getAlturaProduto()
    {
        return $this->alturaProduto;
    }

    /**
     * Set the value of alturaProduto
     *
     * @return  self
     */ 
    public function setAlturaProduto($alturaProduto)
    {
        $this->alturaProduto = $alturaProduto;

        return $this;
    }

    /**
     * Get the value of comprimentoProduto
     */ 
    public function getComprimentoProduto()
    {
        return $this->comprimentoProduto;
    }

    /**
     * Set the value of comprimentoProduto
     *
     * @return  self
     */ 
    public function setComprimentoProduto($comprimentoProduto)
    {
        $this->comprimentoProduto = $comprimentoProduto;

        return $this;
    }

    /**
     * Get the value of larguraProduto
     */ 
    public function getLarguraProduto()
    {
        return $this->larguraProduto;
    }

    /**
     * Set the value of larguraProduto
     *
     * @return  self
     */ 
    public function setLarguraProduto($larguraProduto)
    {
        $this->larguraProduto = $larguraProduto;

        return $this;
    }

    /**
     * Get the value of pesoProduto
     */ 
    public function getPesoProduto()
    {
        return $this->pesoProduto;
    }

    /**
     * Set the value of pesoProduto
     *
     * @return  self
     */ 
    public function setPesoProduto($pesoProduto)
    {
        $this->pesoProduto = $pesoProduto;

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