<?php
include_once("include/factory.php");
if (Auth::isAuthenticated()) {
    header('Location: index.php');
    exit();
}
$mensagem = $_GET['message'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · biblioTECA</title>
    <?php include("include/tema.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
</head>
<body class="login-fundo d-flex align-items-center min-vh-100 py-4">
    <button type="button" class="btn btn-sm btn-outline-light trocar-tema position-absolute top-0 end-0 m-3" aria-label="Trocar entre modo claro e escuro"><i class="bi bi-moon-stars"></i></button>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-6 col-lg-4">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h1 class="h3 text-center mb-1"><i class="bi bi-book-half text-primary"></i> biblioTECA</h1>
                        <p class="text-center text-body-secondary mb-4">Entre com o CPF do funcionário</p>

                        <?php if ($mensagem): ?>
                            <div class="alert alert-danger py-2"><?php echo e($mensagem); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="logar.php">
                            <div class="form-floating mb-3">
                                <input name="cpf" type="text" id="cpf" class="form-control mask-cpf" placeholder="CPF" required autofocus>
                                <label for="cpf">CPF</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="senha" type="password" id="senha" class="form-control" placeholder="Senha" required>
                                <label for="senha">Senha</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
