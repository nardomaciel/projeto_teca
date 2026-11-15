<?php
include_once("include/factory.php");
$user = exigir_login();

$autor = AutorRepository::get($_GET["id"] ?? 0);
if (!$autor) {
    redirecionar("autor_listagem.php", "Autor não encontrado.", "warning");
}

$titulo = "Editar autor";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Editar autor</h1>
        <a href="autor_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="autor_editar_post.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?php echo e($autor->getNome()); ?>" required maxlength="200">
                </div>
                <input type="hidden" name="id" value="<?php echo $autor->getId(); ?>">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
