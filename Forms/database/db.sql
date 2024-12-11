CREATE TABLE matriz (
    id_matriz INT PRIMARY KEY AUTO_INCREMENT,
    curso VARCHAR(255) NOT NULL,
    disciplina VARCHAR(255) NOT NULL,
    semestre VARCHAR(255) NOT NULL,
    periodo_planejamento DATE,
    periodo_oferta DATE,
    nome_professor CHAR(100),
    composicao_nota CHAR(100),
    descricap_disciplina VARCHAR(500),
    ch_total INT,
    ch_a_distancia INT,
    ch_sincrona INT,
    ch_assincrona INT,
    ch_presencial INT,
    total_unidades INT
);

CREATE TABLE unidade_matriz (
    idmatriz INT,
    id_unidade INT PRIMARY KEY AUTO_INCREMENT,
    nome_unidade VARCHAR(255) NOT NULL,
    ch_semestre INT,
    ch_unidade INT,
    inicio_periodo DATE,
    termino_periodo DATE,
    titulo_unidade CHAR(255),
    descricao_unidade VARCHAR(500),
    total_encontros INT,
    total_atividades INT,
    FOREIGN KEY (idmatriz) REFERENCES matriz (id_matriz)
);

CREATE TABLE encontros_unidades (
    id_encontro INT PRIMARY KEY AUTO_INCREMENT,
    tipo_encontro CHAR(100),
    data_encontro DATE,
    idunidade_matriz INT,
    ch_encontro INT,
    inicio_aula CHAR(100),
    termino_aula CHAR(100),
    frequencia CHAR(100),
    FOREIGN KEY (idunidade_matriz) REFERENCES unidade_matriz (id_unidade)
);

CREATE TABLE atividades_unidades (
    id_atividade INT PRIMARY KEY AUTO_INCREMENT,
    tipo_atividade INT,
    ch_atividade INT,
    idunidade_matriz INT,
    peso_atividade INT,
    nota_avaliacao CHAR(100),
    titulo_atividade CHAR(255),
    descricao_atividade VARCHAR(500),
    FOREIGN KEY (idunidade_matriz) REFERENCES unidade_matriz (id_unidade)
);
