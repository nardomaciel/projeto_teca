<?php
include_once("include/factory.php");
$user = exigir_login();

$emprestimo = Factory::emprestimo();
$livros = LivroRepository::listAllWithoutEmprestimoActive();
$clientes = ClienteRepository::listAllWithoutEmprestimoActive();

$titulo = "Novo empréstimo";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Novo empréstimo</h1>
        <a href="emprestimo_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <?php if (!$livros || !$clientes): ?>
        <div class="alert alert-warning">
            <?php if (!$livros): ?>Não há livros disponíveis: todos estão emprestados ou nenhum foi cadastrado.<br><?php endif; ?>
            <?php if (!$clientes): ?>Não há clientes disponíveis: todos estão com um livro ou nenhum foi cadastrado.<?php endif; ?>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="emprestimo_novo_post.php" method="POST" class="row g-3">
                    <div class="col-12">
                        <label for="livro_id" class="form-label">Livro</label>
                        <select name="livro_id" id="livro_id" class="form-select" required>
                            <option value="">Escolha um livro disponível</option>
                            <?php foreach ($livros as $livro): ?>
                                <option value="<?php echo $livro->getId(); ?>"><?php echo e($livro->getTitulo()); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-select" required>
                            <option value="">Escolha o cliente</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente->getId(); ?>"><?php echo e($cliente->getNome()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">Cada cliente pode ficar com um livro por vez.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Data de vencimento</label>
                        <input type="text" class="form-control" value="<?php echo $emprestimo->getDataVencimento("d/m/Y"); ?>" readonly>
                        <div class="form-text">Prazo de 7 dias.</div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Registrar empréstimo</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include("include/footer.php"); ?>
