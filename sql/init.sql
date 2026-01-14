USE meu_banco;

CREATE TABLE IF NOT EXISTS dados (
    id INT NOT NULL,
    nome VARCHAR(50) NOT NULL,
    valor VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);