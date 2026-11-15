<?php
include_once('include/factory.php');
$user = exigir_login();

$titulo = "Livros";
include("include/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Livros</h1>
    <a href="livro_novo.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Novo livro</a>
</div>

<div class="tabela-card table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano</th>
                <th>ISBN</th>
                <th class="acoes">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (LivroRepository::listAll() as $livro):
                $autor = AutorRepository::get($livro->getAutorId()); ?>
                <tr>
                    <td><?php echo $livro->getId(); ?></td>
                    <td><?php echo e($livro->getTitulo()); ?></td>
                    <td><?php echo e($autor ? $autor->getNome() : ''); ?></td>
                    <td><?php echo e($livro->getGenero()); ?></td>
                    <td><?php echo e($livro->getAno()); ?></td>
                    <td><?php echo e($livro->getIsbn()); ?></td>
                    <td class="acoes">
                        <a href="livro_editar.php?id=<?php echo $livro->getId(); ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                        <?php if (EmprestimoRepository::countByLivros($livro->getId()) == 0): ?>
                            <a href="livro_excluir.php?id=<?php echo $livro->getId(); ?>" class="btn btn-sm btn-outline-danger" data-confirmar="Excluir o livro <?php echo e($livro->getTitulo()); ?>?">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("include/footer.php"); ?>
