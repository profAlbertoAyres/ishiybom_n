<?php
// script do banco de dados
// CREATE TABLE usuario (
//     id int NOT NULL AUTO_INCREMENT,
//     nomeUsuario varchar(100) NOT NULL,
//     emailUsuario varchar(100) NOT NULL,
//     senhaUsuario varchar(200) NOT NULL,
//     nivel_acessoUsuario int NOT NULL,
//     PRIMARY KEY (id)
//   ) ;


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Usuario extends CRUD
{

    protected $table = "usuario";
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nivel_acesso;

    //Adiciona um usuário
    public function add()
    {
        $sql = "INSERT INTO $this->table (nomeUsuario, emailUsuario, senhaUsuario, nivel_acessoUsuario) 
                  VALUES (:nome, :email, :senha, :nivel_acesso)";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $stmt->bindParam(':nivel_acesso', $this->nivel_acesso, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao criar usuário: " . $e->getMessage();
            return false;
        }
    }

    // Atualizar um usuário existente
    public function update($campo, $id)
    {
        $sql = "UPDATE $this->table 
                  SET nomeUsuario = :nome, emailUsuario = :email, senhaUsuario = :senha, nivel_acessoUsuario = :nivel_acesso 
                  WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $stmt->bindParam(':nivel_acesso', $this->nivel_acesso, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            return false;
        }
    }

    #Efetuar Login
    public function login()
    {
        $sql = "SELECT * FROM  $this->table WHERE nomeUsuario = :nome";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            if (password_verify($this->senha, $usuario->senhausuario)) {
                $_SESSION['user_id'] = $usuario->id;
                $_SESSION['user_name'] = $usuario->nomeusuario;
                $_SESSION['nivel_acesso'] = $usuario->nivel_acessousuario; // Armazena o nível de acesso
                $_SESSION['ultimaAtividade'] = time(); // Armazena a hora da última atividade
                $redirect_url = $_POST['redirect'] ?? 'dashboard.php';
                header("Location: $redirect_url");
                exit();
            }
        }

        return "Usuário ou Senha incorreta. Por favor, tente novamente.";
    }

    //Efetuar Logoff

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    #Expirar 

    public function sessaoExpirou()
    {
        $tempo = 1800; // 30 minutos de inatividade
        if (isset($_SESSION['ultimaAtividade']) && (time() - $_SESSION['ultimaAtividade']) > $tempo) {
            $this->logout();
            return true;
        }
        $_SESSION['ultimaAtividade'] = time(); // Atualiza a hora da última atividade
        return false;
    }

    public function verificarNivelAcesso(array $nivelNecessario)
    {
        // Verifica se o nível de acesso do usuário atende ao nível necessário
        if (isset($_SESSION['nivel_acesso']) && in_array($_SESSION['nivel_acesso'], $nivelNecessario)) {
            return true; // Usuário tem permissão
        }

        return false; // Usuário não tem permissão

    }

    public function atualizarEmail($nomeUsuario, $email, $senhaAtual)
    {
        try {
            // Verifica se a senha atual está correta
            $sql = "SELECT senhaUsuario FROM $this->table WHERE nomeUsuario = :nomeUsuario";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nomeUsuario', $nomeUsuario);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            if (password_verify($senhaAtual, $usuario->senhausuario)) {
                // Atualiza o e-mail
                $sql = "UPDATE $this->table SET emailUsuario = :email WHERE nomeUsuario = :nomeUsuario";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':nomeUsuario', $nomeUsuario);

                return $stmt->execute();
            } else {

                return false; // Senha inválida
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function alterarSenha($nomeUsuario, $senhaAtual, $novaSenha)
    {
        try {
            // Verifica se a senha atual está correta
            $query = "SELECT senha FROM $this->table WHERE nomeUsuario = :nomeUsuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            if ($usuario && password_verify($senhaAtual, $usuario->senha)) {
                // Atualiza com a nova senha (hash)
                $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
                $query = "UPDATE $this->table SET senha = :novaSenha WHERE nomeUsuario = :nomeUsuario";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':novaSenha', $novaSenhaHash, PDO::PARAM_STR);
                $stmt->bindParam(':nomeUsuario', $nomeUsuario, PDO::PARAM_STR);

                return $stmt->execute();
            } else {
                return false; // Senha atual incorreta
            }
        } catch (PDOException $e) {
            return false;
        }
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getNivel_acesso()
    {
        return $this->nivel_acesso;
    }

    public function setNivel_acesso($nivel_acesso)
    {
        $this->nivel_acesso = $nivel_acesso;

        return $this;
    }
}
