<?php
class Acesso{
    private $usuarios;
    private $formUsuario;
    private $formSenha;
    private $erro = false;
    private $info = false;
    private $user;

    public function __construct()
    {
        $this->usuarios = array(
            array("login" => "coach",   "senha" => "!Coach@15",  "privilegio" => true)
        );

    }


    public function login()
    {
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $this->formUsuario = isset($_POST['user']) && $_POST['user'] != "" ? $_POST['user'] : null;
            $this->formSenha   = isset($_POST['passUser']) && $_POST['passUser'] !== "" ? $_POST['passUser'] : null;

            for($i = 0; $i < count($this->usuarios); $i++){
                if($this->usuarios[$i]["login"] == trim($this->formUsuario) && $this->usuarios[$i]["senha"] == trim($this->formSenha))
                {
                    $_SESSION['Usuario'] = $this->usuarios[$i];
                    
                    header("Location: dashboard.php");
                    return;
                }
            }
            $this->erro = true;
        }
        
    }
    


    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: http://'. $_SERVER['HTTP_HOST']);
    }

    public function ctrlAcesso()
    {
        session_start();
        if(!isset($_SESSION['Usuario'])){
            header('Location: index.php');
        }
    }
    
    public function checkUser()
    {
        session_start();
        if(isset($_SESSION['Usuario'])){
            header('Location: dashboard.php');
        }
    }

    public function displayErr()
    {
        if($this->erro){
            echo '<div class="alert alert-danger" style="padding: 8px;"><p class="alert-link" style="font-size:14px;">Erro no Usuário ou Senha</p></div>';
        }
    }

    public function informativoLogin()
    {
        $this->info = isset($_GET['i']) && $_GET['i'] == 't' ? true : false;
        if($this->info)
        {
            echo '<div class="alert alert-info"><h1>Para exportar precisa estar logado.</h1></div>';
        }
    }
}
