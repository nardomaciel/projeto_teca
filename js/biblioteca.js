$(function () {
    var modal = new bootstrap.Modal('#livroModal');

    // Abre o livro clicado na estante
    $('.livro').on('click', function () {
        var d = $(this).data();
        var $m = $('#livroModal');

        $m.find('#livroModalTitulo, .capa-titulo').text(d.titulo);
        $m.find('.m-autor, .capa-autor').text(d.autor);
        $m.find('.m-ano').text(d.ano);
        $m.find('.capa-genero').text(d.genero);
        $m.find('.m-sinopse').text(d.sinopse || 'Sem sinopse cadastrada.');
        $m.find('.capa').css('--cor', d.cor);
        $m.find('.m-id').val(d.id);
        $m.find('.m-ate').text(d.ate);

        $m.find('.m-disponivel').toggle(!d.ate);
        $m.find('.m-indisponivel').toggle(!!d.ate);

        modal.show();
    });

    $('#livroModal').on('shown.bs.modal', function () {
        $(this).find('.m-disponivel:visible .codigo').trigger('focus');
    });
    $('#consultaModal').on('shown.bs.modal', function () {
        $(this).find('.codigo').trigger('focus');
    });

    // Código sempre em maiúsculas, sem espaços
    $('.codigo').on('input', function () {
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
    });

    // Busca e filtro "só disponíveis"
    function semAcento(texto) {
        return texto.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase();
    }

    function filtrar() {
        var termo = semAcento($('#busca').val().trim());
        var soDisponiveis = $('#soDisponiveis').is(':checked');
        var algum = false;

        $('.prateleira').each(function () {
            var visiveis = 0;
            $(this).find('.livro').each(function () {
                var d = $(this).data();
                var bate = !termo || semAcento(d.titulo + ' ' + d.autor).indexOf(termo) !== -1;
                var mostra = bate && (!soDisponiveis || !d.ate);
                $(this).closest('.vao').toggle(mostra);
                if (mostra) visiveis++;
            });
            $(this).toggle(visiveis > 0);
            if (visiveis > 0) algum = true;
        });

        $('.nada-encontrado').toggleClass('d-none', algum);
    }

    $('#busca').on('input', filtrar);
    $('#soDisponiveis').on('change', filtrar);
});
