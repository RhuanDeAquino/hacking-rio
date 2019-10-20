<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/fomulario.css">
        <title>Formulario</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    </head>
    <body>
        <section class="feedback">
            <div class="block-avaliacao">
                <h1 class="titulo-form">Ghdiwhd Tishaish</h1>
                <div class="buttons">
                    <label for="negativo">
                        <input type="radio" name="option" id="negativo" class="ruim" onclick="teste('ruim')"><p class="nota">Ruim</p>
                    </label>
                    <label for="medio">
                        <input type="radio" name="option" id="medio" class="regular nota" onclick="teste('regular')"> <p class="nota">Regular</p>
                    </label>
                    <label for="positivo">
                            <input type="radio" name="option" id="positivo" class="bom" onclick="teste('bom')"> <p class="nota">Bom</p>
                    </label>
                </div>
                <img src="assets/feliz.png" alt="" class="emote">
                <div class="respostas-repetidas">
                    <label class="respostas" for="topicos">
                            <input type="radio" name="option" id="topicos" class="radio-marc" onclick="teste('bom')">Prazo
                    </label>    
                    <label class="respostas" for="positivo">
                            <input type="radio" name="option" id="topicos" class="radio-marc" onclick="teste('bom')">Atendimento
                    </label>
                    <label class="respostas" for="positivo">
                            <input type="radio" name="option" id="topicos" class="radio-marc" onclick="teste('bom')">Solução
                    </label>
                    <label class="respostas" for="positivo">
                            <input type="radio" name="option" id="topicos" class="radio-marc" onclick="teste('bom')">Facilidade de Acesso ao Serviço
                    </label>
                    <textarea class="texto-livre" name="comentário" rows="10" cols="40" placeholder="Deixe seu feedback..."></textarea>
                </div>
            </div>
        </section>
        <ul class="squares">
        </ul>
        <script src="./js/main.js"></script>
    </body>
</html>