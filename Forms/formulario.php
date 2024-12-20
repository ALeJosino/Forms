<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário Dinâmico</title>
</head>
<body>
    <h2>MATRIZ DE PLANEJAMENTO E DESIGN EDUCACIONAL</h2>
    <form id="dynamicForm" method="POST" action="controller/processa.php">
        <h2>DADOS GERAIS</h2>
        <div class="form-group">
            <label for="curso">Curso</label>
            <input type="text" id="curso" name="curso">
        </div>
        <div class="form-group">
            
            <label for="disciplina">Disciplina</label>
            <input type="text" id="disciplina" name="disciplina">
        </div>
        <div class="form-group">
            <label for="semestre">Semestre</label>
            <input type="text" id="semestre" name="semestre">
        </div>
        <div class="form-group">
            <label for="periodoPlanejamento">Período letivo de planejamento</label>
            <input type="text" id="periodoPlanejamento" name="periodoPlanejamento">
        </div>
        <div class="form-group">
            
            <label for="periodoOferta">Período letivo de oferta</label>
            <input type="text" id="periodoOferta" name="periodoOferta">
        </div>
        <div class="form-group">
            <label for="formatoOferta">Formato de oferta da disciplina</label>
            <input type="text" id="formatoOferta" name="formatoOferta">
        </div>
        <div class="form-group">
            <label for="professor">Professor(a)</label>
            <input type="text" id="professor" name="professor">
        </div>
        
        <h2>COMPOSIÇÃO DE NOTA</h2>
        <p>
AD - atividades/avaliações a distância (atividades/ferramentas do AVA) </br>
AP - avaliações presenciais (provas, seminários etc.) </br>
MAD - média das atividades/avaliações a distância </br>
MAP - média das avaliações presenciais </br>
        </p>
        <div class="photo-options">
            <label>
                <input type="radio" name="modeloFoto" value="modelo1">
                <img src="images/image1.jpeg" alt="Modelo 1" class="option-image">
                <span>Modelo 1</span>
            </label>
            <label>
                <input type="radio" name="modeloFoto" value="modelo2">
                <img src="images/image2.png" alt="Modelo 2" class="option-image">
                <span>Modelo 2</span>
            </label>
        </div>

        <h2>DESCRIÇÃO DO MURAL</h2>
        <div class="textarea-container">
            <label for="comentario"></label>
            <textarea id="comentario" name="comentario" rows="6"></textarea>
        </div>

        <h2>DISTRIBUIÇÃO DE CARGA HORÁRIA</h2>
        <div class="form-group">
            <label for="cargaTotal">Carga horária total da disciplina</label>
            <input type="text" id="cargaTotal" name="cargaTotal" class="input-field">
        </div>
        <div class="form-group">
            <label for="cargaDistancia">Carga horária a distância</label>
            <input type="text" id="cargaDistancia" name="cargaDistancia" class="input-field">            
        </div>
        <div class="form-group">
            <label for="chSincInput">CH síncrona (meets)</label>
            <input type="text" id="chSincInput" name="chSincInput" class="input-field">
        </div>
        <div class="form-group">
            <label for="chAssincrona">CH Assíncrona</label>
            <input type="text" id="chAssincrona" name="chAssincrona" class="input-field">
        </div>
        <div class="form-group">
            <label for="chPresencialInput">Carga horária presencial</label>
            <input type="text" id="chPresencialInput" name="chPresencialInput" class="input-field">
        </div>
        <div class="form-group">
            <label for="totalUnidades">Total de unidades da disciplina</label>
            <select id="totalUnidades" name="totalUnidades" onchange="generateUnits()">
                <option value="0">Selecione</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
        </div>

        <div id="dynamic-fields"></div>
        <button type="button" id="salvarDados" onclick="validar()">Salvar</button>
        
    </form>

    <script src="script.js"></script>

    
</body>

</html>
