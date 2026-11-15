</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script>
    $(function () {
        $('.mask-cpf').mask('000.000.000-00');
        $('.mask-rg').mask('00.000.000-0');
        $('.mask-telefone').mask('(00) 00000-0000');
        $('.mask-data').mask('00/00/0000');
        $('.mask-ano').mask('0000');

        // pede confirmação antes de excluir
        $('[data-confirmar]').on('click', function (evento) {
            if (!confirm($(this).data('confirmar'))) {
                evento.preventDefault();
            }
        });
    });
</script>
</body>
</html>
