<?php
include_once('include/factory.php');
$user = exigir_login();

$titulo = "Cadastrar livros em lote";
include("include/header.php");
?>

<div class="form-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Cadastrar livros em lote</h1>
        <a href="livro_listagem.php" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <p class="mb-2">Cole um livro por linha, com os campos separados por ponto e vírgula:</p>
            <pre class="bg-body-tertiary border rounded p-2 small mb-3">Título; Autor; Ano; Gênero; ISBN; Sinopse (opcional)</pre>
            <p class="small text-body-secondary">
                Se o autor ainda não existir, ele é cadastrado junto. Dá para colar direto de uma planilha
                exportada em CSV com ponto e vírgula. Linhas incompletas são ignoradas e aparecem no resumo.
            </p>

            <form action="livro_lote_post.php" method="POST">
                <div class="mb-3">
                    <label for="linhas" class="form-label">Livros</label>
                    <textarea name="linhas" id="linhas" class="form-control font-monospace small" rows="10" required
                        placeholder="Estrela da Vida Inteira; Manuel Bandeira; 1966; Poesia e teatro; 9786500099990; A reunião dos poemas de Bandeira.&#10;Claro Enigma; Carlos Drummond de Andrade; 1951; Poesia e teatro; 9786500099983"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-upload me-1"></i>Cadastrar</button>
            </form>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
