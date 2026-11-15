<?php
include_once("include/factory.php");
$user = exigir_login();

$titulo = "Novo autor";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Novo autor</h1>
        <a href="autor_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="autor_novo_post.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do autor" required maxlength="200" autofocus>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
