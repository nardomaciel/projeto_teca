<?php
include_once("include/factory.php");
$user = exigir_login();

$funcionario = FuncionarioRepository::get($_GET["id"] ?? 0);
if (!$funcionario) {
    redirecionar("funcionario_listagem.php", "Funcionário não encontrado.", "warning");
}

$titulo = "Trocar senha";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h1 class="h3 mb-0">Trocar senha</h1>
            <p class="text-body-secondary mb-0"><?php echo e($funcionario->getNome()); ?></p>
        </div>
        <a href="funcionario_editar.php?id=<?php echo $funcionario->getId(); ?>" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="funcionario_editar_senha_post.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="senha" class="form-label">Nova senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required minlength="6" maxlength="100" autocomplete="new-password" autofocus>
                </div>
                <div class="col-md-6">
                    <label for="repSenha" class="form-label">Confirmar senha</label>
                    <input type="password" name="repSenha" id="repSenha" class="form-control" required autocomplete="new-password">
                </div>
                <div class="col-12">
                    <input type="hidden" name="id" value="<?php echo $funcionario->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Salvar nova senha</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
