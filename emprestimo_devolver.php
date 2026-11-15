<?php
include_once("include/factory.php");
$user = exigir_login();

$emprestimo = EmprestimoRepository::get($_GET["id"] ?? 0);
if (!$emprestimo) {
    redirecionar("emprestimo_listagem.php", "Empréstimo não encontrado.", "warning");
}

$livro = LivroRepository::get($emprestimo->getLivroId());
$cliente = ClienteRepository::get($emprestimo->getClienteId());

// Multa de R$ 1,00 por dia de atraso
$atraso = dias_de_atraso($emprestimo);
$multa = $atraso * 1;

$titulo = "Devolver livro";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Devolver livro</h1>
        <a href="emprestimo_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="emprestimo_devolver_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label class="form-label">Livro</label>
                    <input type="text" class="form-control" value="<?php echo e($livro->getTitulo()); ?>" disabled>
                </div>
                <div class="col-12">
                    <label class="form-label">Cliente</label>
                    <input type="text" class="form-control" value="<?php echo e($cliente->getNome()); ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Vencimento</label>
                    <input type="text" class="form-control" value="<?php echo $emprestimo->getDataVencimento("d/m/Y"); ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Devolução</label>
                    <input type="text" class="form-control" value="<?php echo date("d/m/Y"); ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Multa por atraso</label>
                    <input type="text" class="form-control <?php echo $multa > 0 ? 'text-danger fw-semibold' : ''; ?>" value="R$ <?php echo number_format($multa, 2, ",", "."); ?>" disabled>
                    <?php if ($atraso > 0): ?><div class="form-text"><?php echo $atraso; ?> dias de atraso</div><?php endif; ?>
                </div>
                <div class="col-12">
                    <input type="hidden" name="id" value="<?php echo $emprestimo->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Confirmar devolução</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
