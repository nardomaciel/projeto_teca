<?php
include_once("include/factory.php");
$user = exigir_login();

$total_livros = count(LivroRepository::listAll());
$total_clientes = count(ClienteRepository::listAll());
$total_ativos = count(EmprestimoRepository::listAtivos());
$vencidos = EmprestimoRepository::listVencido();

$titulo = "Início";
include("include/header.php");
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h3 mb-0">Olá, <?php echo e(explode(' ', $user->getNome())[0]); ?></h1>
        <p class="text-body-secondary mb-0">Hoje é <?php echo date('d/m/Y'); ?></p>
    </div>
    <a href="emprestimo_novo.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo empréstimo</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <a href="livro_listagem.php" class="card card-numero h-100 text-decoration-none">
            <div class="card-body">
                <div class="text-body-secondary small"><i class="bi bi-journal-bookmark me-1"></i>Livros</div>
                <div class="display-6 fw-semibold"><?php echo $total_livros; ?></div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="cliente_listagem.php" class="card card-numero h-100 text-decoration-none">
            <div class="card-body">
                <div class="text-body-secondary small"><i class="bi bi-people me-1"></i>Clientes</div>
                <div class="display-6 fw-semibold"><?php echo $total_clientes; ?></div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="emprestimo_listagem_ativos.php" class="card card-numero h-100 text-decoration-none">
            <div class="card-body">
                <div class="text-body-secondary small"><i class="bi bi-arrow-left-right me-1"></i>Empréstimos ativos</div>
                <div class="display-6 fw-semibold"><?php echo $total_ativos; ?></div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="emprestimo_listagem_vencidos.php" class="card card-numero h-100 text-decoration-none <?php echo $vencidos ? 'border-danger' : ''; ?>">
            <div class="card-body">
                <div class="text-body-secondary small"><i class="bi bi-exclamation-circle me-1"></i>Vencidos</div>
                <div class="display-6 fw-semibold <?php echo $vencidos ? 'text-danger' : ''; ?>"><?php echo count($vencidos); ?></div>
            </div>
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold">Empréstimos vencidos</div>
    <?php if (!$vencidos): ?>
        <div class="card-body text-body-secondary">Nenhum empréstimo vencido. Tudo em dia.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Livro</th><th>Cliente</th><th>Vencimento</th><th>Atraso</th><th></th></tr>
                </thead>
                <tbody>
                    <?php foreach ($vencidos as $emprestimo): ?>
                        <tr>
                            <td><?php echo e(LivroRepository::get($emprestimo->getLivroId())->getTitulo()); ?></td>
                            <td><?php echo e(ClienteRepository::get($emprestimo->getClienteId())->getNome()); ?></td>
                            <td><?php echo $emprestimo->getDataVencimento('d/m/Y'); ?></td>
                            <td><span class="badge text-bg-danger"><?php echo dias_de_atraso($emprestimo); ?> dias</span></td>
                            <td class="text-end"><a href="emprestimo_devolver.php?id=<?php echo $emprestimo->getId(); ?>" class="btn btn-sm btn-outline-primary">Devolver</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include("include/footer.php"); ?>
