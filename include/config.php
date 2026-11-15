<?php
// Configuração do banco. Ajuste aqui conforme o seu ambiente.
//
// SQLite (padrão): não precisa instalar nada. Na primeira vez que o sistema
//         abrir, o banco é criado sozinho em database/teca.sqlite, já com dados de exemplo.
// MySQL (XAMPP, Laragon): importe database/projeto_teca.sql no phpMyAdmin
//         e troque 'driver' para 'mysql'.

return [
    'driver'  => 'sqlite',
    'host'    => 'localhost',
    'banco'   => 'projeto_teca',
    'usuario' => 'root',
    'senha'   => '',
    'sqlite'  => __DIR__ . '/../database/teca.sqlite',
];
