<?php // Aplica o tema salvo (ou o do sistema) antes da página aparecer, para não piscar. ?>
<script>
    (function () {
        var tema = null;
        try { tema = localStorage.getItem('tema'); } catch (e) {}
        if (tema !== 'light' && tema !== 'dark') {
            tema = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        document.documentElement.setAttribute('data-bs-theme', tema);
    })();
</script>
