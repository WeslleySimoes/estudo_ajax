/**
 * 
 * JAVASCRIPT IMPORT E EXPORT

    https://www.youtube.com/watch?v=vylVbb2PY0M&ab_channel=TiagoMatos

    DICAS DE VSCODE

    https://www.youtube.com/watch?v=qJ_M4W0u5rI&ab_channel=C%C3%B3digoFonteTV

    USANDO GIT SOURCETREE

    https://www.youtube.com/results?search_query=git+sourcetree


    COMO LER PARÂMETROS DA URL COM JAVASCRIPT(QUERY STRING)

    https://www.youtube.com/watch?v=wzG6ELTfGC0&ab_channel=MatheusBattisti-HoradeCodar

 */


// ------------------------
// ANOTAÇÕES JAVASCRIPT
// ------------------------

// Links com ajuda de script javascript
//https://www.w3schools.com/howto/howto_js_toggle_text.asp

// https://stackabuse.com/get-query-string-values-in-javascript/


// ####################################################

// foreach array
let nomes = ['weslley','marcela','maria'];

nomes.forEach((nome,index) => {
    console.log(`Index: ${index} | Nome: ${nome}`);
});


// ####################################################
//Tipos de debug
console.log('Exemplo');

console.table({
    nome : 'Weslley',
    sobrenome: 'Simões'
});

// Retorna o tipo do dado
console.log ( typeof 42 );
console.log ( typeof 'ola' );

// Inserindo o valor de uma variável dentro de um texto
let nome  = 'weslley';
let texto = `Seja bem vindo, ${$nome}`;

// ####################################################

// Criando um elemento html
let div = document.createElement('div');
let p  = document.createElement('p');

// Adicionando uma classe a um elemento HTML
p.classList.add('classeExemplo');

p.textContent = 'Olá pessoal'; //Adicionando texto dentro do elemento html

// Adicionando uma tag html dentro da outra
div.appendChild(p);

// Adicionando elemento depois de outro elemento
elementoSuperior.insertAdjacentElement('afterend',elementoDepois);

// ####################################################

// Criando uma tag '<img>' e alterando sua propriedad 'src'
$elemento_img = document.createElement('img');
$elemento_img.src = "https://www.4devs.com.br/4devs_gerador_imagem.php?acao=gerar_imagem&txt_largura=320&txt_altura=240&extensao=png&fundo_r=0.06274509803921569&fundo_g=0.996078431372549&fundo_b=0.9568627450980393&texto_r=0&texto_g=0&texto_b=0&texto=Gerador%20Imagem%20%234Devs&tamanho_fonte=10";

// ####################################################
// Transforma a string ajax em um objeto, caso receba somente uma informação, caso sejam várias, então retorna-rá um array de objetos.
$string_json = '{nome: "weslley",sobrenome:"simoes"}';
JSON.parse($string_json);






