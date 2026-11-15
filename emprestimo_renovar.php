<?php
include_once("include/factory.php");
$user = exigir_login();

$emprestimo = EmprestimoRepository::get($_GET["id"] ?? 0);
if (!$emprestimo) {
    redirecionar("emprestimo_listagem.php", "Empréstimo não encontrado.", "warning");
}

$livro = LivroRepository::get($emprestimo->getLivroId());
$cliente = ClienteRepository::get($emprestimo->getClienteId());
$emprestimo_novo = Factory::emprestimo();

$titulo = "Renovar empréstimo";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Renovar empréstimo</h1>
        <a href="emprestimo_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="emprestimo_renovar_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label class="form-label">Livro</label>
                    <input type="text" class="form-control" value="<?php echo e($livro->getTitulo()); ?>" disabled>
                </div>
                <div class="col-12">
                    <label class="form-label">Cliente</label>
                    <input type="text" class="form-control" value="<?php echo e($cliente->getNome()); ?>" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Vencimento atual</label>
                    <input type="text" class="form-control" value="<?php echo $emprestimo->getDataVencimento("d/m/Y"); ?>" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Novo vencimento</label>
                    <input type="text" class="form-control fw-semibold" value="<?php echo $emprestimo_novo->getDataVencimento("d/m/Y"); ?>" readonly>
                </div>
                <div class="col-12">
                    <input type="hidden" name="id" value="<?php echo $emprestimo->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Renovar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
