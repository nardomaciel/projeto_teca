<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<style>
    
</style>
<body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">biblioTECA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        AUTOR
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="autor_listagem.php">LISTAGEM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="cliente_listagem.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CLIENTE
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="cliente_listagem.php">LISTAGEM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        EMPRESTIMO
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">LISTAGEM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="funcionario_listagem.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        FUNCIONARIO
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="funcionario_listagem.php">LISTAGEM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        LIVRO
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="livro_listagem.php">LISTAGEM</a></li>
                    </ul>
                </li>

            </ul>
            <button type="button" class="btn btn-danger"><a id="sair" href="logout.php">sair</a></button>
        </div>
    </div>


</nav>
</body>

</html>