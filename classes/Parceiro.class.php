<?php
  
class Parceiro extends CRUD{
    protected $table = "parceiro";
    private $idParceiro;
    private $nomeParceiro;
    private $enderecoParceiro;
    private $telefoneParceiro;
    private $horarioParceiro;
    private $bairroParceiro;
    private $cidadeParceiro;
    private $estadoParceiro;



    /**
     * Get the value of nome
     */ 
    public function getNomeParceiro()
    {
        return $this->nomeParceiro;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNomeParceiro($nomeParceiro)
    {
        $this->nomeParceiro = $nomeParceiro;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getIdParceiro()
    {
        return $this->idParceiro;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdParceiro($idParceiro)
    {
        $this->idParceiro = $idParceiro;

        return $this;
    }

   public function getEnderecoParceiro()
    {
        return $this->enderecoParceiro;
    }

  
    public function setEnderecoParceiro($enderecoParceiro)
    {
        $this->enderecoParceiro = $enderecoParceiro;

        return $this;
    }

     public function getTelefoneoParceiro()
    {
        return $this->telefoneParceiro;
    }

  
    public function setTelefoneParceiro($telefoneParceiro)
    {
        $this->telefoneParceiro = $telefoneParceiro;

        return $this;
    }

     public function getHorarioParceiro()
    {
        return $this->horarioParceiro;
    }

  
    public function setHorarioParceiro($horarioParceiro)
    {
        $this->horarioParceiro = $horarioParceiro;

        return $this;
    }

     public function getBairroParceiro()
    {
        return $this->bairroParceiro;
    }

  
    public function setBairroParceiro($bairroParceiro)
    {
        $this->bairroParceiro = $bairroParceiro;

        return $this;
    }

     public function getCidadeParceiro()
    {
        return $this->cidadeParceiro;
    }

  
    public function setCidadeParceiro($cidadeParceiro)
    {
        $this->cidadeParceiro = $cidadeParceiro;

        return $this;
    }

     public function getEstadoParceiro()
    {
        return $this->estadoParceiro;
    }

  
    public function setEstadoParceiro($estadoParceiro)
    {
        $this->estadoParceiro = $estadoParceiro;

        return $this;
    }




    public function add(){
        // SQL de inserção
        $sql = "INSERT INTO $this->table (nomeparceiro, enderecoparceiro, telefoneparceiro, horarioparceiro, bairroparceiro, cidadeparceiro, estadoparceiro) VALUES (:nomeparceiro, :enderecoparceiro, :telefoneparceiro, :horarioparceiro, :bairroparceiro, :cidadeparceiro, :estadoparceiro)";


        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeparceiro', $this->nomeParceiro);
        $stmt->bindParam(':enderecoparceiro', $this->enderecoParceiro);
        $stmt->bindParam(':telefoneparceiro', $this->telefoneParceiro);
        $stmt->bindParam(':horarioparceiro', $this->horarioParceiro);
        $stmt->bindParam(':bairroparceiro', $this->bairroParceiro);
        $stmt->bindParam(':cidadeparceiro', $this->cidadeParceiro);
        $stmt->bindParam(':estadoparceiro', $this->estadoParceiro);


        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    public function update($campo, $id){
        $sql = "UPDATE $this->table SET nomeparceiro=:nomeparceiro, enderecoparceiro=:enderecoparceiro, telefoneparceiro=:telefoneparceiro, horarioparceiro=:horarioparceiro, bairroparceiro=:bairroparceiro, cidadeparceiro=:cidadeparceiro, estadoparceiro=:estadoparceiro  WHERE $campo=:idParceiro";
        $stmt = $this->db->prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomeparceiro', $this->nomeParceiro);
        $stmt->bindParam(':enderecoparceiro', $this->enderecoParceiro);
        $stmt->bindParam(':telefoneparceiro', $this->telefoneParceiro);
        $stmt->bindParam(':horarioparceiro', $this->horarioParceiro);
        $stmt->bindParam(':bairroparceiro', $this->bairroParceiro);
        $stmt->bindParam(':cidadeparceiro', $this->cidadeParceiro);
        $stmt->bindParam(':estadoparceiro', $this->estadoParceiro);
        $stmt->bindParam(':idParceiro', $id);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }
}