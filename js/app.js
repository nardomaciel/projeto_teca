$(function () {
    // Máscaras dos campos
    $('.mask-cpf').mask('000.000.000-00');
    $('.mask-rg').mask('00.000.000-0');
    $('.mask-telefone').mask('(00) 00000-0000');
    $('.mask-data').mask('00/00/0000');
    $('.mask-ano').mask('0000');

    // Pede confirmação antes de excluir
    $('[data-confirmar]').on('click', function (evento) {
        if (!confirm($(this).data('confirmar'))) {
            evento.preventDefault();
        }
    });

    // Troca entre modo claro e escuro e lembra a escolha
    function aplicarTema(tema) {
        document.documentElement.setAttribute('data-bs-theme', tema);
        $('.trocar-tema i').attr('class', tema === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars');
        $('.trocar-tema').attr('title', tema === 'dark' ? 'Usar modo claro' : 'Usar modo escuro');
    }

    aplicarTema(document.documentElement.getAttribute('data-bs-theme') || 'light');

    $('.trocar-tema').on('click', function () {
        var novo = document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
        aplicarTema(novo);
        try { localStorage.setItem('tema', novo); } catch (e) {}
    });
});
