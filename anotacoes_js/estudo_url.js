/*
    https://stackabuse.com/get-query-string-values-in-javascript/

    ================================================

    O window.location

    objeto pode ser usado para obter o endereço da página atual (URL) e redirecionar o navegador para uma nova página.

    Alguns exemplos:

    window.location.href     -> Retorna o href (URL) da página atual
    window.location.hostname -> Retorna o nome de domínio do host da web
    window.location.pathname -> Retorna o caminho e o nome do arquivo da página atual
    window.location.protocol -> Retorna o protocolo da web usado (http: ou https:)
    window.location.assign() -> carrega um novo documento

*/

// Obtendo as queries
let queryGET = window.location.search; //Exemplo: ?nome=weslley&sobrenome=simoes

// Obtendo o valor de cada query separadas
let params = new URLSearchParams(queryGET); // Passando a query via parâmetro

params.get('nome'); // Retorna: 'weslley'
params.get('sobrenome'); // Retorna: 'Simões'


https://stackabuse.com/get-query-string-values-in-javascript/
