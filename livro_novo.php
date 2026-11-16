<?php
include_once('include/factory.php');
$user = exigir_login();

$autores = AutorRepository::listAll();
if (!$autores) {
    redirecionar("autor_novo.php", "Cadastre um autor antes de cadastrar livros.", "warning");
}

$titulo = "Novo livro";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Novo livro</h1>
        <a href="livro_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="livro_novo_post.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título do livro" required maxlength="200" autofocus>
                </div>
                <div class="col-12">
                    <label for="autor_id" class="form-label">Autor</label>
                    <select name="autor_id" id="autor_id" class="form-select" required>
                        <option value="">Escolha o autor</option>
                        <?php foreach ($autores as $autor): ?>
                            <option value="<?php echo $autor->getId(); ?>"><?php echo e($autor->getNome()); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="genero" class="form-label">Gênero</label>
                    <input type="text" name="genero" id="genero" class="form-control" placeholder="Romance, ficção, aventura..." required maxlength="100">
                </div>
                <div class="col-md-3">
                    <label for="ano" class="form-label">Ano</label>
                    <input type="text" name="ano" id="ano" class="form-control mask-ano" placeholder="aaaa" required>
                </div>
                <div class="col-md-4">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" placeholder="13 números" required maxlength="13">
                </div>
                <div class="col-12">
                    <label for="sinopse" class="form-label">Sinopse</label>
                    <textarea name="sinopse" id="sinopse" class="form-control" rows="3" maxlength="600" placeholder="Um resumo curto que aparece na biblioteca online"></textarea>
                </div>
                <div class="col-md-4">
                    <label for="cor" class="form-label">Cor da lombada</label>
                    <input type="color" name="cor" id="cor" class="form-control form-control-color w-100" value="<?php echo cor_lombada(random_int(0, 9)); ?>">
                    <div class="form-text">É a cor do livro na estante.</div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
