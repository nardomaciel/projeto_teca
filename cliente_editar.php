<?php
include_once("include/factory.php");
$user = exigir_login();

$cliente = ClienteRepository::get($_GET["id"] ?? 0);
if (!$cliente) {
    redirecionar("cliente_listagem.php", "Cliente não encontrado.", "warning");
}

$titulo = "Editar cliente";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Editar cliente</h1>
        <a href="cliente_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="cliente_editar_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?php echo e($cliente->getNome()); ?>" required maxlength="200">
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control mask-telefone" value="<?php echo e($cliente->getTelefone()); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo e($cliente->getEmail()); ?>" required maxlength="200">
                </div>
                <div class="col-md-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control mask-cpf" value="<?php echo e($cliente->getCpf()); ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="rg" class="form-label">RG</label>
                    <input type="text" name="rg" id="rg" class="form-control mask-rg" value="<?php echo e($cliente->getRg()); ?>">
                </div>
                <div class="col-md-4">
                    <label for="data_nascimento" class="form-label">Data de nascimento</label>
                    <input type="text" name="data_nascimento" id="data_nascimento" class="form-control mask-data" value="<?php echo e($cliente->getDataNascimento('d/m/Y')); ?>" required>
                </div>
                <div class="col-12">
                    <div class="alert alert-secondary d-flex flex-wrap align-items-center gap-2 mb-0 py-2">
                        <i class="bi bi-key"></i>
                        Código de acesso à biblioteca online:
                        <code class="codigo-acesso"><?php echo e($cliente->getCodigoAcesso() ?: 'sem código'); ?></code>
                        <a href="cliente_codigo.php?id=<?php echo $cliente->getId(); ?>" class="ms-auto small" data-confirmar="Gerar um novo código? O atual deixa de funcionar.">Gerar outro</a>
                    </div>
                </div>
                <div class="col-12">
                    <input type="hidden" name="id" value="<?php echo $cliente->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
