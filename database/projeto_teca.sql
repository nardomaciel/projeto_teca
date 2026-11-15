-- Banco da biblioTECA para MySQL / MariaDB.
-- No phpMyAdmin: aba Importar, escolha este arquivo e execute.
-- Login inicial: CPF 123.456.789-09, senha "biblioteca".

CREATE DATABASE IF NOT EXISTS projeto_teca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projeto_teca;

CREATE TABLE funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(200),
    data_inclusao DATETIME,
    data_alteracao DATETIME,
    inclusao_funcionario_id INT,
    alteracao_funcionario_id INT
);

CREATE TABLE autor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    data_inclusao DATETIME,
    data_alteracao DATETIME,
    inclusao_funcionario_id INT,
    alteracao_funcionario_id INT
);

CREATE TABLE livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    ano INT,
    genero VARCHAR(100),
    isbn VARCHAR(13),
    autor_id INT NOT NULL,
    data_inclusao DATETIME,
    data_alteracao DATETIME,
    inclusao_funcionario_id INT,
    alteracao_funcionario_id INT,
    FOREIGN KEY (autor_id) REFERENCES autor (id)
);

CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(200),
    cpf VARCHAR(14),
    rg VARCHAR(20),
    data_nascimento DATE,
    data_inclusao DATETIME,
    data_alteracao DATETIME,
    inclusao_funcionario_id INT,
    alteracao_funcionario_id INT
);

CREATE TABLE emprestimo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT NOT NULL,
    cliente_id INT NOT NULL,
    data_vencimento DATE NOT NULL,
    data_inclusao DATETIME,
    data_alteracao DATETIME,
    data_renovacao DATE,
    data_devolucao DATETIME,
    inclusao_funcionario_id INT,
    alteracao_funcionario_id INT,
    renovacao_funcionario_id INT,
    devolucao_funcionario_id INT,
    FOREIGN KEY (livro_id) REFERENCES livro (id),
    FOREIGN KEY (cliente_id) REFERENCES cliente (id)
);

-- Funcionário inicial (senha: biblioteca)
INSERT INTO funcionario (nome, cpf, telefone, senha, email, data_inclusao)
VALUES ('Administrador', '123.456.789-09', '(45) 99999-0000', '$2y$10$jfTb5p1ksHn5S3Tk7d9JSuL4bxYTuxJXhF.KpdjtFnO7XJLGpzNx.', 'admin@biblioteca.local', NOW());

-- Alguns dados de exemplo para o sistema não abrir vazio
INSERT INTO autor (nome, data_inclusao, inclusao_funcionario_id) VALUES
('Machado de Assis', NOW(), 1),
('Clarice Lispector', NOW(), 1),
('Graciliano Ramos', NOW(), 1),
('Jorge Amado', NOW(), 1);

INSERT INTO livro (titulo, ano, genero, isbn, autor_id, data_inclusao, inclusao_funcionario_id) VALUES
('Dom Casmurro', 1899, 'Romance', '9788535901047', 1, NOW(), 1),
('Memórias Póstumas de Brás Cubas', 1881, 'Romance', '9788571642157', 1, NOW(), 1),
('A Hora da Estrela', 1977, 'Romance', '9788532513267', 2, NOW(), 1),
('Vidas Secas', 1938, 'Romance', '9788501034373', 3, NOW(), 1),
('Capitães da Areia', 1937, 'Romance', '9788582855485', 4, NOW(), 1);

INSERT INTO cliente (nome, telefone, email, cpf, rg, data_nascimento, data_inclusao, inclusao_funcionario_id) VALUES
('Ana Beatriz Rocha', '(45) 99911-0022', 'ana.rocha@email.com', '111.444.777-35', '12.345.678-9', '1998-03-14', NOW(), 1),
('Bruno Henrique Lima', '(45) 99922-0033', 'bruno.lima@email.com', '529.982.247-25', '98.765.432-1', '2001-07-02', NOW(), 1),
('Carla Mendes', '(45) 99933-0044', 'carla.mendes@email.com', '935.411.347-80', '11.222.333-4', '1985-11-23', NOW(), 1);

INSERT INTO emprestimo (livro_id, cliente_id, data_vencimento, data_inclusao, inclusao_funcionario_id) VALUES
(1, 1, DATE_ADD(CURDATE(), INTERVAL 4 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY), 1),
(3, 2, DATE_SUB(CURDATE(), INTERVAL 5 DAY), DATE_SUB(NOW(), INTERVAL 12 DAY), 1);
