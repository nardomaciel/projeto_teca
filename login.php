<?php
    include_once("include/factory.php");
   if(Auth::isAuthenticated()){
       header('Location: index.php');
       exit();
   }
?>
<style>
   
</style>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form" method="POST" action="logar.php">
            <input name="cpf" type="text" id="cpf" placeholder="CPF" required>
            <input name= "senha" type="password" id="password" placeholder="Password (min. 10 characters)" required>
            <button type="submit">Login</button>
        </form>
        <p id="error-message"></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
 <script>
    $(document).ready(function() { 
            $('#cpf').mask('000.000.000-00', {reverse: true});
            
        });
 </script>
</body>

</html>