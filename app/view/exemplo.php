<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button id="btn-clicar">Clique</button>
    <p id="textoAqui"></p>

    <script>
        let btnClicar = document.querySelector('#btn-clicar');
        let textoAqui = document.querySelector('#textoAqui');

        $elemento_img = document.createElement('img');
        $elemento_img.src = "https://www.4devs.com.br/4devs_gerador_imagem.php?acao=gerar_imagem&txt_largura=320&txt_altura=240&extensao=png&fundo_r=0.06274509803921569&fundo_g=0.996078431372549&fundo_b=0.9568627450980393&texto_r=0&texto_g=0&texto_b=0&texto=Gerador%20Imagem%20%234Devs&tamanho_fonte=10";

        textoAqui.appendChild($elemento_img);

        btnClicar.addEventListener('click',function(event) {
            event.preventDefault();

            textoAqui.innerHTML = '<h1> Olá mundo </h1>';
        });
    </script>
</body> 
</html>