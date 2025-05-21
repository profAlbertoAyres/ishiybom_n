<?php

class FotoProduto extends CRUD
{
    protected $table = "fotoproduto";
    private $idFotoProd;
    private $produtoFoto;
    private $nomeFoto;

    public function add()
    {
        // SQL de inserção
        $sql = "INSERT INTO $this->table (nomefoto, produtofoto) 
         VALUES (:nomefoto, :produtofoto)";
        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nomefoto', $this->nomeFoto);
        $stmt->bindParam(':produtofoto', $this->produtoFoto);
        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }
    public function update($campo, $id)
    {
    }

    public function allPhoto(int $id)
    {
        $sql = "SELECT * FROM  $this->table WHERE produtofoto = :idProd";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idProd', $id, PDO::PARAM_INT);
        // Executar a consulta e verificar se funcionou
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Get the value of idFotoProd
     */
    public function getIdFotoProd()
    {
        return $this->idFotoProd;
    }

    /**
     * Set the value of idFotoProd
     *
     * @return  self
     */
    public function setIdFotoProd($idFotoProd)
    {
        $this->idFotoProd = $idFotoProd;

        return $this;
    }

    /**
     * Get the value of produtoFoto
     */
    public function getProdutoFoto()
    {
        return $this->produtoFoto;
    }

    /**
     * Set the value of produtoFoto
     *
     * @return  self
     */
    public function setProdutoFoto($produtoFoto)
    {
        $this->produtoFoto = $produtoFoto;

        return $this;
    }

    /**
     * Get the value of nomeFoto
     */
    public function getNomeFoto()
    {
        return $this->nomeFoto;
    }

    /**
     * Set the value of nomeFoto
     *
     * @return  self
     */
    public function setNomeFoto($nomeFoto)
    {
        $this->nomeFoto = $nomeFoto;

        return $this;
    }
}