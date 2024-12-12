<?php
require_once '../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Inserção na tabela matriz
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
        $idmatriz = $pdo->lastInsertId();

        if (!$idmatriz) {
            throw new Exception("Erro ao inserir dados na tabela matriz.");
        }

        // Inserção na tabela unidade_matriz
        $totalUnidades = (int)$_POST['totalUnidades'];
        for ($unidadeIndex = 1; $unidadeIndex <= $totalUnidades; $unidadeIndex++) {
            $unidadeData = [
                ':idmatriz' => $_POST['idmatriz'] ?? null,
                ':nome_unidade' => $_POST["nomeUnidade{$unidadeIndex}"] ?? null,
                ':ch_semestre' => $_POST["chSemestre{$unidadeIndex}"] ?? null,
                ':ch_unidade' => $_POST["chUnidade{$unidadeIndex}"] ?? null,
                ':inicio_periodo' => $_POST["inicioPeriodo{$unidadeIndex}"] ?? null,
                ':termino_periodo' => $_POST["terminoPeriodo{$unidadeIndex}"] ?? null,
                ':titulo_unidade' => $_POST["tituloUnidade{$unidadeIndex}"] ?? null,
                ':descricao_unidade' => $_POST["descricaoUnidade{$unidadeIndex}"] ?? null,
                ':total_encontros' => $_POST["totalEncontros{$unidadeIndex}"] ?? null,
                ':total_atividades' => $_POST["totalAtividades{$unidadeIndex}"] ?? null,
            ];

            $unidadeSql = "INSERT INTO unidade_matriz (
                idmatriz, nome_unidade, ch_semestre, ch_unidade, inicio_periodo, termino_periodo, 
                titulo_unidade, descricao_unidade, total_encontros, total_atividades
            ) VALUES (
                :idmatriz, :nome_unidade, :ch_semestre, :ch_unidade, :inicio_periodo, :termino_periodo, 
                :titulo_unidade, :descricao_unidade, :total_encontros, :total_atividades
            )";

            $stmt = $pdo->prepare($unidadeSql);
            $stmt->execute($unidadeData);
            $unidadeId = $pdo->lastInsertId();

            if (!$unidadeId) {
                throw new Exception("Erro ao inserir dados na tabela unidade_matriz para a unidade {$unidadeIndex}.");
            }

            // Inserção na tabela encontros_unidades
            $totalEncontros = (int)$_POST["totalEncontros{$unidadeIndex}"];
            for ($encontroIndex = 1; $encontroIndex <= $totalEncontros; $encontroIndex++) {
                $encontroData = [
                    ':unidadeId' => $unidadeId,
                    ':tipo' => $_POST["encontroTipo{$unidadeIndex}_{$encontroIndex}"] ?? null,
                    ':data' => $_POST["dataEncontro{$unidadeIndex}_{$encontroIndex}"] ?? null,
                    ':ch' => $_POST["chEncontro{$unidadeIndex}_{$encontroIndex}"] ?? null,
                    ':inicioAula' => $_POST["inicioAula{$unidadeIndex}_{$encontroIndex}"] ?? null,
                    ':fimAula' => $_POST["fimAula{$unidadeIndex}_{$encontroIndex}"] ?? null,
                    ':frequencia' => $_POST["frequenciaEncontro{$unidadeIndex}_{$encontroIndex}"] ?? null,
                ];

                $encontroSql = "INSERT INTO encontros_unidades (
                    idunidade_matriz, tipo_encontro, data_encontro, ch_encontro, 
                    inicio_aula, termino_aula, frequencia
                ) VALUES (
                    :unidadeId, :tipo, :data, :ch, :inicioAula, :fimAula, :frequencia
                )";

                $stmt = $pdo->prepare($encontroSql);
                $stmt->execute($encontroData);
            }

            // Inserção na tabela atividades_unidades
            $totalAtividades = (int)$_POST["totalAtividades{$unidadeIndex}"];
            for ($atividadeIndex = 1; $atividadeIndex <= $totalAtividades; $atividadeIndex++) {
                $atividadeData = [
                    ':tipo_atividade' => $_POST["tipoAtividade{$unidadeIndex}_{$atividadeIndex}"] ?? null,
                    ':ch_atividade' => $_POST["chAtividade{$unidadeIndex}_{$atividadeIndex}"] ?? null,
                    ':idunidade_matriz' => $unidadeId,
                    ':peso_atividade' => $_POST["pesoAtividade{$unidadeIndex}_{$atividadeIndex}"] ?? null,
                    ':nota_avaliacao' => $_POST["notaAtividade{$unidadeIndex}_{$atividadeIndex}"] ?? null,
                    ':titulo_atividade' => $_POST["tituloAtividade{$unidadeIndex}_{$atividadeIndex}"] ?? null,
                    ':descricao_atividade' => $_POST["descricaoAtividade{$unidadeIndex}_{$atividadeIndex}"] ?? null,
                ];

                $atividadeSql = "INSERT INTO atividades_unidades (
                    tipo_atividade, ch_atividade, idunidade_matriz, peso_atividade, 
                    nota_avaliacao, titulo_atividade, descricao_atividade
                ) VALUES (
                    :tipo_atividade, :ch_atividade, :idunidade_matriz, :peso_atividade, 
                    :nota_avaliacao, :titulo_atividade, :descricao_atividade
                )";

                $stmt = $pdo->prepare($atividadeSql);
                $stmt->execute($atividadeData);
            }
        }

        echo "Dados inseridos com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao salvar os dados: " . $e->getMessage();
    }
}
