<?php

class Inicial extends CRUD{
    protected $table = "inicial";
    private $idInicial;
    private $tituloInicial;
    private $textoInicial;
    private $imagemInicial;
    private $ordemInicial;
    private $ativoInicial;


    public function add(){

        $sql = "INSERT INTO $this->table (tituloinicial, textoinicial, imageminicial, ordemInicial) VALUES (:tituloinicial, :textoinicial, :imageminicial, :ordemInicial)";

        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':tituloinicial', $this->tituloInicial);
        $stmt->bindParam(':textoinicial', $this->textoInicial);
        $stmt->bindParam(':imageminicial', $this->imagemInicial);
        $stmt->bindParam(':ordemInicial', $this->ordemInicial);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    public function update($field, $id){
        $sql = "UPDATE $this->table SET tituloinicial = :tituloinicial, textoinicial = :textoinicial, imageminicial = :imageminicial, ordemInicial=:ordeminicial WHERE idinicial= :id";

        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':tituloinicial', $this->tituloInicial);
        $stmt->bindParam(':textoinicial', $this->textoInicial);
        $stmt->bindParam(':imageminicial', $this->imagemInicial);
        $stmt->bindParam(':ordeminicial', $this->ordemInicial);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }


    public function allOrder() {
        $sql = "SELECT * FROM $this->table where ativoinicial = 1 order by ordeminicial";
        $stmt = $this->db->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Get the value of idInicial
     */ 
    public function getIdInicial()
    {
        return $this->idInicial;
    }

    /**
     * Set the value of idInicial
     *
     * @return  self
     */ 
    public function setIdInicial($idInicial)
    {
        $this->idInicial = $idInicial;

        return $this;
    }

    /**
     * Get the value of tituloInicial
     */ 
    public function gettItuloInicial()
    {
        return $this->tituloInicial;
    }

    /**
     * Set the value of tituloInicial
     *
     * @return  self
     */ 
    public function settItuloInicial($tituloInicial)
    {
        $this->tituloInicial = $tituloInicial;

        return $this;
    }

    /**
     * Get the value of textoInicial
     */ 
    public function getTextoInicial()
    {
        return $this->textoInicial;
    }

    /**
     * Set the value of textoInicial
     *
     * @return  self
     */ 
    public function setTextoInicial($textoInicial)
    {
        $this->textoInicial = $textoInicial;

        return $this;
    }

    /**
     * Get the value of imagemInicial
     */ 
    public function getImagemInicial()
    {
        return $this->imagemInicial;
    }

    /**
     * Set the value of imagemInicial
     *
     * @return  self
     */ 
    public function setImagemInicial($imagemInicial)
    {
        $this->imagemInicial = $imagemInicial;

        return $this;
    }

    /**
     * Get the value of ativoInicial
     */ 
    public function getOrderInicial()
    {
        return $this->ordemInicial;
    }

    /**
     * Set the value of ordeminicial
     *
     * @return  self
     */ 
    public function setOrderInicial($orderInicial)
    {
        $this->ordemInicial = $orderInicial;

        return $this;
    }
    public function getAtivoInicial()
    {
        return $this->ativoInicial;
    }

    /**
     * Set the value of ativoInicial
     *
     * @return  self
     */ 
    public function setAtivoInicial($ativoInicial)
    {
        $this->ativoInicial = $ativoInicial;

        return $this;
    }
}