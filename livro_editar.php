<?php
include_once("include/factory.php");
$user = exigir_login();

$livro = LivroRepository::get($_GET["id"] ?? 0);
if (!$livro) {
    redirecionar("livro_listagem.php", "Livro não encontrado.", "warning");
}

$titulo = "Editar livro";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Editar livro</h1>
        <a href="livro_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="livro_editar_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo e($livro->getTitulo()); ?>" required maxlength="200">
                </div>
                <div class="col-12">
                    <label for="autor_id" class="form-label">Autor</label>
                    <select name="autor_id" id="autor_id" class="form-select" required>
                        <?php foreach (AutorRepository::listAll() as $autor): ?>
                            <option value="<?php echo $autor->getId(); ?>" <?php echo $livro->getAutorId() == $autor->getId() ? 'selected' : ''; ?>>
                                <?php echo e($autor->getNome()); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="genero" class="form-label">Gênero</label>
                    <input type="text" name="genero" id="genero" class="form-control" value="<?php echo e($livro->getGenero()); ?>" required maxlength="100">
                </div>
                <div class="col-md-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="text" name="ano" id="ano" class="form-control mask-ano" value="<?php echo e($livro->getAno()); ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" value="<?php echo e($livro->getIsbn()); ?>" required maxlength="13">
                </div>
                <div class="col-12">
                    <input type="hidden" name="id" value="<?php echo $livro->getId(); ?>">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
