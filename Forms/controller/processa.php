<?php
require_once '../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            ':curso' => $_POST['curso'] ?? null,
            ':disciplina' => $_POST['disciplina'] ?? null,
            ':semestre' => $_POST['semestre'] ?? null,
            ':periodoPlanejamento' => $_POST['periodoPlanejamento'] ?? null,
            ':periodoOferta' => $_POST['periodoOferta'] ?? null,
            ':professor' => $_POST['professor'] ?? null,
            ':composicaoNota' => $_POST['modeloFoto'] ?? null,
            ':descricaoMural' => $_POST['comentario'] ?? null,
            ':chTotal' => $_POST['cargaTotal'] ?? null,
            ':chADistancia' => $_POST['cargaDistancia'] ?? null,
            ':chSincrona' => $_POST['cargaSincrona'] ?? null,
            ':chAssincrona' => $_POST['cargaAssincrona'] ?? null,
            ':chPresencial' => $_POST['cargaPresencial'] ?? null,
            ':totalUnidades' => $_POST['totalUnidades'] ?? null,
        ];

        $sql = "INSERT INTO matriz (
                    curso, disciplina, semestre, periodo_planejamento, 
                    periodo_oferta, nome_professor, composicao_nota, 
                    descricao_disciplina, ch_total, ch_a_distancia, 
                    ch_sincrona, ch_assincrona, ch_presencial, total_unidades
                ) VALUES (
                    :curso, :disciplina, :semestre, :periodoPlanejamento, 
                    :periodoOferta, :professor, :composicaoNota, 
                    :descricaoMural, :chTotal, :chADistancia, 
                    :chSincrona, :chAssincrona, :chPresencial, :totalUnidades
                )";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);


        //query das unidades
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $sql = "INSERT INTO unidade_matriz (idmatriz, nome_unidade, ch_semestre, ch_unidade, inicio_periodo, termino_periodo, titulo_unidade, descricao_unidade, total_encontros, total_atividades)
            VALUES (:idmatriz, :nome_unidade, :ch_semestre, :ch_unidade, :inicio_periodo, :termino_periodo, :titulo_unidade, :descricao_unidade, :total_encontros, :total_atividades)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':idmatriz' => $idmatriz,
                ':nome_unidade' => $nome_unidade,
                ':ch_semestre' => $ch_semestre,
                ':ch_unidade' => $ch_unidade,
                ':inicio_periodo' => $inicio_periodo,
                ':termino_periodo' => $termino_periodo,
                ':titulo_unidade' => $titulo_unidade,
                ':descricao_unidade' => $descricao_unidade,
                ':total_encontros' => $total_encontros,
                ':total_atividades' => $total_atividades
            ]);
        }



        //econtro das unidades

        if($_SERVER['REQUEST_METHOD'] === 'POST'){$sql = "INSERT INTO encontros_unidades (tipo_encontro, data_encontro, idunidade_matriz, ch_encontro, inicio_aula, termino_aula, frequencia)
        VALUES (:tipo_encontro, :data_encontro, :idunidade_matriz, :ch_encontro, :inicio_aula, :termino_aula, :frequencia)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':tipo_encontro' => $tipo_encontro,
            ':data_encontro' => $data_encontro,
            ':idunidade_matriz' => $idunidade_matriz,
            ':ch_encontro' => $ch_encontro,
            ':inicio_aula' => $inicio_aula,
            ':termino_aula' => $termino_aula,
            ':frequencia' => $frequencia
        ]); 
    }
        



        //atividades da unidade
        $sql = "INSERT INTO atividades_unidades (tipo_atividade, ch_atividade, idunidade_matriz, peso_atividade, nota_avaliacao, titulo_atividade, descricao_atividade)
        VALUES (:tipo_atividade, :ch_atividade, :idunidade_matriz, :peso_atividade, :nota_avaliacao, :titulo_atividade, :descricao_atividade)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':tipo_atividade' => $tipo_atividade,
            ':ch_atividade' => $ch_atividade,
            ':idunidade_matriz' => $idunidade_matriz,
            ':peso_atividade' => $peso_atividade,
            ':nota_avaliacao' => $nota_avaliacao,
            ':titulo_atividade' => $titulo_atividade,
            ':descricao_atividade' => $descricao_atividade
        ]);

        echo "Dados inseridos com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao salvar os dados: " . $e->getMessage();
    }
}
