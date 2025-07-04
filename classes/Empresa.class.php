<?php
  
class Empresa extends CRUD{
    protected $table = "empresa";
    private $idEmpresa;
    private $razaoSocialEmpresa;
    private $nomeFantasiaEmpresa;
    private $enderecoEmpresa;
    private $bairroEmpresa;
    private $cidadeEmpresa;
    private $estadoEmpresa;
    private $logoPequenoEmpresa;
    private $logoGrandeEmpresa;
    private $bannerEmpresa;
    private $horarioEmpresa;
    private $localizacaoEmpresa;



    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

   
    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;

        return $this;
    }
    public function getRazaoSocialEmpresa()
    {
        return $this->razaoSocialEmpresa;
    }


    public function setRazaoSocialEmpresa($razaosocialEmpresa)
    {
        $this->razaoSocialEmpresa = $razaosocialEmpresa;

        return $this;
    }

    public function getNomeFantasiaEmpresa()
    {
        return $this->nomeFantasiaEmpresa;
    }

   
    public function setNomeFantasiaEmpresa($nomeFantasiaEmpresa)
    {
        $this->nomeFantasiaEmpresa = $nomeFantasiaEmpresa;

        return $this;
    }

   
   public function getEnderecoEmpresa()
    {
        return $this->enderecoEmpresa;
    }

  
    public function setEnderecoEmpresa($enderecoEmpresa)
    {
        $this->enderecoEmpresa = $enderecoEmpresa;

        return $this;
    }

    public function getBairroEmpresa()
    {
        return $this->bairroEmpresa;
    }

  
    public function setBairroEmpresa($bairroEmpresa)
    {
        $this->bairroEmpresa = $bairroEmpresa;

        return $this;
    }

     public function getCidadeEmpresa()
    {
        return $this->cidadeEmpresa;
    }

  
    public function setCidadeEmpresa($cidadeEmpresa)
    {
        $this->cidadeEmpresa = $cidadeEmpresa;

        return $this;
    }

     public function getEstadoEmpresa()
    {
        return $this->estadoEmpresa;
    }

  
    public function setEstadoEmpresa($estadoEmpresa)
    {
        $this->estadoEmpresa = $estadoEmpresa;

        return $this;
    }

    public function getLogoPequenoEmpresa()
    {
        return $this->logoPequenoEmpresa;
    }

  
    public function setLogoPequenoEmpresa($logoPequenoEmpresa)
    {
        $this->logoPequenoEmpresa = $logoPequenoEmpresa;

        return $this;
    }

    public function getLogoGrandeEmpresa()
    {
        return $this->logoGrandeEmpresa;
    }

  
    public function setLogoGrandeEmpresa($logoGrandeEmpresa)
    {
        $this->logoGrandeEmpresa = $logoGrandeEmpresa;

        return $this;
    }
    
    public function getBannerEmpresa()
    {
        return $this->bannerEmpresa;
    }

  
    public function setBannerEmpresa($bannerEmpresa)
    {
        $this->bannerEmpresa = $bannerEmpresa;
        return $this;
    }
    
    public function getHorarioEmpresa()
    {
        return $this->horarioEmpresa;
    }

  
    public function setHorarioEmpresa($horarioEmpresa)
    {
        $this->horarioEmpresa = $horarioEmpresa;

        return $this;
    }

    public function getlocalizacaoEmpresa()
    {
        return $this->localizacaoEmpresa;
    }

  
    public function setlocalizacaoEmpresa($localizacaoEmpresa)
    {
        $this->localizacaoEmpresa = $localizacaoEmpresa;

        return $this;
    }

    public function add(){
        // SQL de inserção
        $sql = "INSERT INTO $this->table (razaosocialempresa,nomefantasiaempresa, enderecoempresa, bairroempresa, cidadeEmpresa, estadoempresa, logopequenoempresa, logograndeempresa, bannerempresalocalizacaoempresa, horarioempresa) VALUES (:razaosocialempresa, :nomefantasiaempresa, :enderecoempresa, :bairroempresa, :cidadeempresa,  :estadoempresa,:logopequenoempresa, :logograndeempresa, :bannerempresa, :localizacaoempresa, :horarioempresa)";

        // Preparar a declaração usando a classe Database
        $stmt = $this->db->prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':razaosocialempresa', $this->razaoSocialEmpresa);
        $stmt->bindParam(':nomefantasiaempresa', $this->razaoSocialEmpresa);
        $stmt->bindParam(':enderecoempresa', $this->enderecoEmpresa);
        $stmt->bindParam(':bairroempresa', $this->bairroEmpresa);
        $stmt->bindParam(':cidadeempresa', $this->cidadeEmpresa);
        $stmt->bindParam(':estadoempresa', $this->estadoEmpresa);
        $stmt->bindParam(':logopequenoempresa', $this->logoPequenoEmpresa);
        $stmt->bindParam(':logograndeempresa', $this->logoGrandeEmpresa);
        $stmt->bindParam(':bannerempresa', $this->bannerEmpresa);
        $stmt->bindParam(':localizacaoempresa', $this->localizacaoEmpresa);
        $stmt->bindParam(':horarioempresa', $this->horarioEmpresa);


        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    public function update($campo, $id){
        $sql = "UPDATE $this->table SET razaosocialEmpresa=:razaosocialEmpresa, nomefantasiaempresa=:nomefantasiaempresa,enderecoempresa=:enderecoempresa, bairroempresa=:bairroempresa, cidadeempresa=:cidadeempresa, estadoempresa=:estadoempresa, logopequenoempresa = :logopequenoempresa, logograndeempresa=:logograndeempresa, bannerempresa=:bannerempresa, localizacaoempresa=:localizacaoempresa, horarioempresa=:horarioempresa  WHERE $campo=:idEmpresa";
        $stmt = $this->db->prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':razaosocialEmpresa', $this->razaoSocialEmpresa);
        $stmt->bindParam(':nomefantasiaempresa', $this->razaoSocialEmpresa);
        $stmt->bindParam(':enderecoempresa', $this->enderecoEmpresa);
        $stmt->bindParam(':bairroempresa', $this->bairroEmpresa);
        $stmt->bindParam(':cidadeempresa', $this->cidadeEmpresa);
        $stmt->bindParam(':estadoempresa', $this->estadoEmpresa);
        $stmt->bindParam(':logopequenoempresa', $this->logoPequenoEmpresa);
        $stmt->bindParam(':logograndeempresa', $this->logoGrandeEmpresa);
        $stmt->bindParam(':bannerempresa', $this->bannerEmpresa);
        $stmt->bindParam(':localizacaoempresa', $this->localizacaoEmpresa);
        $stmt->bindParam(':horarioempresa', $this->horarioEmpresa);
        $stmt->bindParam(':idEmpresa', $id);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }

    public function last(string $campo) {
        $sql = "SELECT * FROM $this->table ORDER BY $campo DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_OBJ) : null;
    }

}