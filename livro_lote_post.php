<?php
include_once('include/factory.php');
$user = exigir_login();

$linhas = preg_split('/\r\n|\r|\n/', $_POST['linhas'] ?? '');

// Autores já cadastrados, pelo nome, para não duplicar
$autores = [];
foreach (AutorRepository::listAll() as $autor) {
    $autores[mb_strtolower(trim($autor->getNome()))] = $autor->getId();
}

$cadastrados = 0;
$ignoradas = [];

foreach ($linhas as $numero => $linha) {
    if (trim($linha) == '') {
        continue;
    }

    $campos = array_map('trim', explode(';', $linha));
    [$titulo, $nome_autor, $ano, $genero, $isbn] = array_pad($campos, 5, '');
    $sinopse = $campos[5] ?? '';

    if ($titulo == '' || $nome_autor == '' || !preg_match('/^\d{1,4}$/', $ano) || $genero == '' || $isbn == '') {
        $ignoradas[] = $numero + 1;
        continue;
    }

    $chave = mb_strtolower($nome_autor);
    if (!isset($autores[$chave])) {
        $autor = Factory::autor();
        $autor->setNome($nome_autor);
        $autor->setInclusaoFuncionarioId($user->getId());
        $autor->setDataInclusao(date('Y-m-d H:i:s'));
        $autores[$chave] = AutorRepository::insert($autor);
    }

    $livro = Factory::livro();
    $livro->setTitulo($titulo);
    $livro->setAno($ano);
    $livro->setGenero($genero);
    $livro->setIsbn(substr($isbn, 0, 13));
    $livro->setSinopse($sinopse);
    $livro->setCor(null);
    $livro->setAutorId($autores[$chave]);
    $livro->setInclusaoFuncionarioId($user->getId());
    $livro->setDataInclusao(date('Y-m-d H:i:s'));
    LivroRepository::insert($livro);
    $cadastrados++;
}

if ($cadastrados == 0) {
    redirecionar("livro_lote.php", "Nenhum livro cadastrado. Confira se cada linha tem título, autor, ano, gênero e ISBN.", "danger");
}

$mensagem = $cadastrados == 1 ? "1 livro cadastrado." : "$cadastrados livros cadastrados.";
if ($ignoradas) {
    $mensagem .= " Linhas ignoradas por estarem incompletas: " . implode(', ', $ignoradas) . ".";
}
redirecionar("livro_listagem.php", $mensagem, $ignoradas ? "warning" : "success");
