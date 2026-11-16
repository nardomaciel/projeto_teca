<?php
// Área pública: a estante com os livros. Não precisa de login.
include_once("include/factory.php");

$livros = LivroRepository::listParaEstante();

// Agrupa por gênero, cada gênero vira uma prateleira
$prateleiras = [];
foreach ($livros as $livro) {
    $prateleiras[$livro->genero ?: 'Outros'][] = $livro;
}
ksort($prateleiras);

$total = count($livros);
$disponiveis = count(array_filter($livros, fn($l) => !$l->emprestado_ate));

function id_prateleira($genero){
    $sem_acento = strtr(mb_strtolower($genero), ['á' => 'a', 'à' => 'a', 'â' => 'a', 'ã' => 'a', 'é' => 'e', 'ê' => 'e',
        'í' => 'i', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ú' => 'u', 'ç' => 'c']);
    return 'prateleira-' . trim(preg_replace('/[^a-z0-9]+/', '-', $sem_acento), '-');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca online · biblioTECA</title>
    <?php include("include/tema.php"); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/biblioteca.css" rel="stylesheet">
</head>
<body class="biblioteca">

<header class="topo-biblioteca">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <a href="biblioteca.php" class="marca"><i class="bi bi-book-half"></i> biblioTECA</a>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#consultaModal">
                    <i class="bi bi-person-check me-1"></i><span class="d-none d-sm-inline">Meu empréstimo</span>
                </button>
                <button type="button" class="btn btn-sm btn-outline-light trocar-tema" aria-label="Trocar entre modo claro e escuro"><i class="bi bi-moon-stars"></i></button>
            </div>
        </div>

        <div class="chamada">
            <h1>Escolha um livro na estante</h1>
            <p>
                Clique em uma lombada para ver o livro. Para levar, digite o código de acesso que você recebeu
                na biblioteca: o empréstimo fica no seu nome por 7 dias.
            </p>
            <p class="contagem"><strong><?php echo $disponiveis; ?></strong> de <?php echo $total; ?> livros na estante agora</p>
        </div>
    </div>
</header>

<div class="barra-filtros sticky-top">
    <div class="container d-flex flex-wrap align-items-center gap-2 py-2">
        <div class="busca flex-grow-1">
            <i class="bi bi-search"></i>
            <input type="search" id="busca" class="form-control" placeholder="Buscar por título ou autor" autocomplete="off">
        </div>
        <div class="form-check form-switch mb-0 ms-1">
            <input class="form-check-input" type="checkbox" role="switch" id="soDisponiveis">
            <label class="form-check-label small" for="soDisponiveis">Só disponíveis</label>
        </div>
        <nav class="generos w-100" aria-label="Ir para a prateleira">
            <?php foreach ($prateleiras as $genero => $lista): ?>
                <a href="#<?php echo id_prateleira($genero); ?>" class="genero"><?php echo e($genero); ?> <span><?php echo count($lista); ?></span></a>
            <?php endforeach; ?>
        </nav>
    </div>
</div>

<main class="container py-4">
    <?php mostrar_mensagem(); ?>

    <?php if (!$livros): ?>
        <div class="text-center text-body-secondary py-5">
            <i class="bi bi-bookshelf fs-1 d-block mb-2"></i>
            A estante ainda está vazia.
        </div>
    <?php endif; ?>

    <div class="estantes">
    <?php foreach ($prateleiras as $genero => $lista): ?>
        <section class="prateleira" id="<?php echo id_prateleira($genero); ?>">
            <h2 class="placa"><?php echo e($genero); ?></h2>
            <div class="estante">
                <?php foreach ($lista as $livro):
                    $altura = 150 + ($livro->id * 37) % 48;
                    $largura = 34 + ($livro->id * 13) % 16;
                    $disponivel = !$livro->emprestado_ate;
                    ?>
                    <div class="vao">
                        <button type="button"
                            class="livro <?php echo $disponivel ? '' : 'emprestado'; ?>"
                            style="--cor: <?php echo cor_lombada($livro->id, $livro->cor); ?>; --altura: <?php echo $altura; ?>px; --largura: <?php echo $largura; ?>px"
                            data-id="<?php echo $livro->id; ?>"
                            data-titulo="<?php echo e($livro->titulo); ?>"
                            data-autor="<?php echo e($livro->autor); ?>"
                            data-ano="<?php echo e($livro->ano); ?>"
                            data-genero="<?php echo e($livro->genero); ?>"
                            data-sinopse="<?php echo e($livro->sinopse); ?>"
                            data-cor="<?php echo cor_lombada($livro->id, $livro->cor); ?>"
                            data-ate="<?php echo $disponivel ? '' : data_br($livro->emprestado_ate); ?>"
                            title="<?php echo e($livro->titulo . ' · ' . $livro->autor); ?>">
                            <span class="titulo"><?php echo e($livro->titulo); ?></span>
                            <span class="autor"><?php echo e($livro->autor); ?></span>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
    </div>

    <p class="nada-encontrado text-center text-body-secondary py-5 d-none">
        <i class="bi bi-search fs-2 d-block mb-2"></i>Nenhum livro encontrado com essa busca.
    </p>
</main>

<footer class="rodape-biblioteca py-4">
    <div class="container d-flex flex-wrap justify-content-between gap-2 small">
        <span><i class="bi bi-book-half me-1"></i>biblioTECA · biblioteca online</span>
        <a href="login.php">Área do funcionário</a>
    </div>
</footer>

<!-- Detalhe do livro -->
<div class="modal fade" id="livroModal" tabindex="-1" aria-labelledby="livroModalTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-5">
                        <div class="capa">
                            <span class="capa-genero"></span>
                            <span class="capa-titulo"></span>
                            <span class="capa-autor"></span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="p-4">
                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            <h2 class="h4 mb-1" id="livroModalTitulo"></h2>
                            <p class="text-body-secondary mb-3"><span class="m-autor"></span> · <span class="m-ano"></span></p>
                            <p class="m-sinopse"></p>

                            <div class="m-disponivel">
                                <span class="badge text-bg-success mb-3"><i class="bi bi-check2 me-1"></i>Na estante</span>
                                <form action="biblioteca_emprestar.php" method="POST">
                                    <input type="hidden" name="livro_id" class="m-id">
                                    <label for="codigo" class="form-label small">Seu código de acesso</label>
                                    <div class="input-group">
                                        <input type="text" name="codigo" id="codigo" class="form-control text-uppercase codigo" maxlength="6" placeholder="Ex.: CAR8P3" required autocomplete="off">
                                        <button type="submit" class="btn btn-primary">Pegar emprestado</button>
                                    </div>
                                    <div class="form-text">O código é entregue pela biblioteca no seu cadastro.</div>
                                </form>
                            </div>

                            <div class="m-indisponivel">
                                <span class="badge text-bg-secondary mb-2"><i class="bi bi-clock me-1"></i>Emprestado</span>
                                <p class="small text-body-secondary mb-0">Esse livro volta para a estante até <strong class="m-ate"></strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Consulta do próprio empréstimo -->
<div class="modal fade" id="consultaModal" tabindex="-1" aria-labelledby="consultaTitulo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="biblioteca_consultar.php" method="POST">
            <div class="modal-header">
                <h2 class="modal-title h5" id="consultaTitulo">Meu empréstimo</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <label for="codigoConsulta" class="form-label">Digite seu código de acesso para ver o livro que está com você.</label>
                <input type="text" name="codigo" id="codigoConsulta" class="form-control text-uppercase codigo" maxlength="6" required autocomplete="off">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Consultar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/app.js"></script>
<script src="js/biblioteca.js"></script>
</body>
</html>
