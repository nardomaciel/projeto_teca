<?php
    include_once("include/factory.php");
   if(!Auth::isAuthenticated()){
       header('Location: login.php');
       exit();
   }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">biblioTECA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">livro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">autor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">emprestimo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">funcionario</a>
        </li>
      </ul>
    </div>
  </div>
  <a href="logout.php">sair</a>
</nav>

<section >

</section>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>