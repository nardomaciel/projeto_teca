<?php
class Auth{
    private static $expires_time = 1200;
    public static function login($cpf, $senha){
        $funcionario = FuncionarioRepository::getByCPF($cpf);

        if($funcionario){
            if($funcionario->checkSenha($senha)){
                $_SESSION['is_authenticated'] = true;
                $_SESSION['funcionario_id'] = $funcionario->getId();
                $_SESSION["auth_expired_at"] = time()  + self::$expires_time; //Definindo tempo de expiração da sessão
                
                return "Usuário logado com sucesso!";
            }
                return "A senha informada é inválida.";
        }
        return "O CPF informado não existe.";
    }


    public static function logout(){
        unset($_SESSION['is_authenticated']);
        unset($_SESSION['funcionario_id']);
        unset($_SESSION["auth_expired_at"]);
    }
    public static function isAuthenticated(){
        if(isset($_SESSION['is_authenticated'])){
            if($_SESSION["is_authenticated"]){
                if($_SESSION["auth_expired_at"]>= time()){
                    $_SESSION["auth_expired_at"]= time() + self::$expires_time; //renova a sessão de autenticação
                    return true;
                }
            }
        }
        self::logout();
        return false;
    }
    public static function getUser(){
        if(self::isAuthenticated()){
            return FuncionarioRepository::get($_SESSION['funcionario_id']);
        }
        return null;
    }
    
}
    
?>
