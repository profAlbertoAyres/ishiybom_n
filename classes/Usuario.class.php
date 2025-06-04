<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
                  SET nomeUsuario = :nome, emailUsuario = :email, nivel_acessoUsuario = :nivel_acesso WHERE $campo = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':nivel_acesso', $this->nivel_acesso, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
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



    public function solicitarRecuperacaoSenha($email)
    {
        require __DIR__ . '/../PHPMailer/src/Exception.php';
        require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
        require __DIR__ . '/../PHPMailer/src/SMTP.php';
        try {
            // Verifica se o e-mail está cadastrado
            $sql = "SELECT id FROM $this->table WHERE emailUsuario = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_OBJ);

                // Gera token seguro
                $token = bin2hex(random_bytes(32));
                $expira_em = date('Y-m-d H:i:s', strtotime('+1 hour'));

                // Insere token na tabela de recuperação
                $sql = "INSERT INTO recuperacao_senha (id_usuario, token, expira_em) 
                    VALUES (:id_usuario, :token, :expira_em)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id_usuario', $usuario->id, PDO::PARAM_INT);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':expira_em', $expira_em, PDO::PARAM_STR);
                $stmt->execute();

                // Monta link de recuperação
                $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
                $dominio = $_SERVER['HTTP_HOST'];
                $caminho = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

                $link = "$protocolo://$dominio$caminho/reset_senha.php?token=$token";

                // Configura PHPMailer
                $mail = new PHPMailer(true);

                try {
                    $config = parse_ini_file(__DIR__ . '/../config.ini', true)['email'];
                    // Configurações do servidor
                    $mail->isSMTP();
                    $mail->Host = "{$config['Host']}";
                    $mail->SMTPAuth = $config['SMTPAuth'];
                    $mail->Username = "{$config['Username']}";
                    $mail->Password = "{$config['Password']}";
                    $mail->SMTPSecure = $config['SMTPSecure'];
                    $mail->Port = $config['Port'];
                    $mail->CharSet = 'UTF-8';

                    // Remetente e destinatário
                    $mail->setFrom('betoprogramar@gmail.com', 'Nome do Sistema');
                    $mail->addAddress($email);

                    // Conteúdo
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperação de Senha';
                    $mail->Body = "
                    <p>Olá,</p>
                    <p>Recebemos uma solicitação para redefinir sua senha.</p>
                    <p>Clique no link abaixo para criar uma nova senha:</p>
                    <p><a href='$link'>$link</a></p>
                    <p>Este link expira em 1 hora.</p>
                    <p>Se você não solicitou isso, ignore este e-mail.</p>
                ";

                    $mail->AltBody = "Olá,\n\nAcesse o link para redefinir sua senha: $link\n\nEste link expira em 1 hora.";

                    $mail->send();
                    return true;

                } catch (Exception $e) {
                    error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
                    return false;
                }

            } else {
                return false; // E-mail não encontrado
            }

        } catch (PDOException $e) {
            error_log('Erro em solicitarRecuperacaoSenha: ' . $e->getMessage());
            return false;
        }
    }


    public function redefinirSenha($token, $novaSenha)
    {
        try {
            // Verifica o token
            $sql = "SELECT id_usuario, expira_em FROM recuperacao_senha WHERE token = :token";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $dados = $stmt->fetch(PDO::FETCH_OBJ);

                if (strtotime($dados->expira_em) >= time()) {
                    // Atualiza a senha
                    $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
                    $sql = "UPDATE $this->table SET senhaUsuario = :novaSenha WHERE id = :id_usuario";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':novaSenha', $novaSenhaHash, PDO::PARAM_STR);
                    $stmt->bindParam(':id_usuario', $dados->id_usuario, PDO::PARAM_INT);
                    $stmt->execute();

                    // Remove o token usado
                    $sql = "DELETE FROM recuperacao_senha WHERE token = :token";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                    $stmt->execute();

                    return true;
                } else {
                    return false; // Token expirado
                }
            } else {
                return false; // Token inválido
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
