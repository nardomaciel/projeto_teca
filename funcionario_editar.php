<?php
include_once("include/factory.php");
$user = exigir_login();

$funcionario = FuncionarioRepository::get($_GET["id"] ?? 0);
if (!$funcionario) {
    redirecionar("funcionario_listagem.php", "Funcionário não encontrado.", "warning");
}

$titulo = "Editar funcionário";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Editar funcionário</h1>
        <a href="funcionario_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="funcionario_editar_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?php echo e($funcionario->getNome()); ?>" required maxlength="200">
                </div>
                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control mask-cpf" value="<?php echo e($funcionario->getCpf()); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control mask-telefone" value="<?php echo e($funcionario->getTelefone()); ?>" required>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo e($funcionario->getEmail()); ?>" required maxlength="200">
                </div>
                <div class="col-12 d-flex gap-2">
                    <input type="hidden" name="id" value="<?php echo $funcionario->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="funcionario_editar_senha.php?id=<?php echo $funcionario->getId(); ?>" class="btn btn-outline-secondary"><i class="bi bi-key me-1"></i>Trocar senha</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
