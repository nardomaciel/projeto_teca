-- Mesmo banco, para SQLite. É carregado sozinho na primeira vez
-- quando include/config.php está com 'driver' => 'sqlite'.
-- Login inicial: CPF 123.456.789-09, senha "biblioteca".

CREATE TABLE funcionario (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    cpf TEXT NOT NULL UNIQUE,
    telefone TEXT,
    senha TEXT NOT NULL,
    email TEXT,
    data_inclusao TEXT,
    data_alteracao TEXT,
    inclusao_funcionario_id INTEGER,
    alteracao_funcionario_id INTEGER
);

CREATE TABLE autor (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    data_inclusao TEXT,
    data_alteracao TEXT,
    inclusao_funcionario_id INTEGER,
    alteracao_funcionario_id INTEGER
);

CREATE TABLE livro (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titulo TEXT NOT NULL,
    ano INTEGER,
    genero TEXT,
    isbn TEXT,
    autor_id INTEGER NOT NULL REFERENCES autor (id),
    data_inclusao TEXT,
    data_alteracao TEXT,
    inclusao_funcionario_id INTEGER,
    alteracao_funcionario_id INTEGER
);

CREATE TABLE cliente (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    telefone TEXT,
    email TEXT,
    cpf TEXT,
    rg TEXT,
    data_nascimento TEXT,
    data_inclusao TEXT,
    data_alteracao TEXT,
    inclusao_funcionario_id INTEGER,
    alteracao_funcionario_id INTEGER
);

CREATE TABLE emprestimo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    livro_id INTEGER NOT NULL REFERENCES livro (id),
    cliente_id INTEGER NOT NULL REFERENCES cliente (id),
    data_vencimento TEXT NOT NULL,
    data_inclusao TEXT,
    data_alteracao TEXT,
    data_renovacao TEXT,
    data_devolucao TEXT,
    inclusao_funcionario_id INTEGER,
    alteracao_funcionario_id INTEGER,
    renovacao_funcionario_id INTEGER,
    devolucao_funcionario_id INTEGER
);

INSERT INTO funcionario (nome, cpf, telefone, senha, email, data_inclusao)
VALUES ('Administrador', '123.456.789-09', '(45) 99999-0000', '$2y$10$jfTb5p1ksHn5S3Tk7d9JSuL4bxYTuxJXhF.KpdjtFnO7XJLGpzNx.', 'admin@biblioteca.local', datetime('now', 'localtime'));

INSERT INTO autor (nome, data_inclusao, inclusao_funcionario_id) VALUES
('Machado de Assis', datetime('now', 'localtime'), 1),
('Clarice Lispector', datetime('now', 'localtime'), 1),
('Graciliano Ramos', datetime('now', 'localtime'), 1),
('Jorge Amado', datetime('now', 'localtime'), 1);

INSERT INTO livro (titulo, ano, genero, isbn, autor_id, data_inclusao, inclusao_funcionario_id) VALUES
('Dom Casmurro', 1899, 'Romance', '9788535901047', 1, datetime('now', 'localtime'), 1),
('Memórias Póstumas de Brás Cubas', 1881, 'Romance', '9788571642157', 1, datetime('now', 'localtime'), 1),
('A Hora da Estrela', 1977, 'Romance', '9788532513267', 2, datetime('now', 'localtime'), 1),
('Vidas Secas', 1938, 'Romance', '9788501034373', 3, datetime('now', 'localtime'), 1),
('Capitães da Areia', 1937, 'Romance', '9788582855485', 4, datetime('now', 'localtime'), 1);

INSERT INTO cliente (nome, telefone, email, cpf, rg, data_nascimento, data_inclusao, inclusao_funcionario_id) VALUES
('Ana Beatriz Rocha', '(45) 99911-0022', 'ana.rocha@email.com', '111.444.777-35', '12.345.678-9', '1998-03-14', datetime('now', 'localtime'), 1),
('Bruno Henrique Lima', '(45) 99922-0033', 'bruno.lima@email.com', '529.982.247-25', '98.765.432-1', '2001-07-02', datetime('now', 'localtime'), 1),
('Carla Mendes', '(45) 99933-0044', 'carla.mendes@email.com', '935.411.347-80', '11.222.333-4', '1985-11-23', datetime('now', 'localtime'), 1);

INSERT INTO emprestimo (livro_id, cliente_id, data_vencimento, data_inclusao, inclusao_funcionario_id) VALUES
(1, 1, date('now', 'localtime', '+4 days'), datetime('now', 'localtime', '-3 days'), 1),
(3, 2, date('now', 'localtime', '-5 days'), datetime('now', 'localtime', '-12 days'), 1);
