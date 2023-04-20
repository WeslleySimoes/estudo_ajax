// ================================================
/*
    PROMISE -> PROMESSA
    
    As Promises são um novo estilo de uso de javascript assíncrono.

    As mais recentes WEB APIs(Fetch) e bibliotecas de Ajax (Axios, etc)  baseiam-se no uso de Promises.

    Fetch API é a versão moderna do XMLHttpRequest

    
*/

// Quando a promessa for comprida ai vai ser executado o 'then'
fetch('http://localhost/estudo_ajax/?m=buscarTodosClientes').then(response => {

    //Vamos verificar se há algum erro, ou seja, se o ResponseStatus da api é diferente de 200
    if(response.status != 200) 
    {
        //Mostrar mensagem de erro
        throw Error('Não foi possível obter o recurso pretendido');
    }else{

        // transforma o json retornado em objeto
        // Ou se for uma lista de json então vai retornar uma lista de objetos
        return response.json();
    }
}).then(cliente => {
    console.log(cliente[199]);
}).catch(erro => {  //catch => Para caso haja algum erro, ele possa tratar.
    console.log('Aconteceu um erro:'+erro.message);
}); 


// ================================================

/*
    Async e Await

    https://teamtreehouse.com/community/what-is-the-difference-between-json-and-jsonparse#:~:text=The%20difference%20is%3A,)%20JavaScript%20object(s).


    https://stackabuse.com/get-query-string-values-in-javascript/

    
*/

// 


// ================================================

/*
    Fetch api 

    A forma mais simples sonsiste em chamar o método fetch e passar a URL do endporint onde vamos buscar os dados.

    Como a Fetch Api retorna sempre uma promise, podemos usar os métodos das Promises(classe): then, catch, finally.

*/

fetch('https://restcountries.com/v3.1/all') //retorna uma promisse(promessa)
    .then(response => {          // Obtém a resposta da promessa, onde também retorna um Promise
        return response.json();  // Transforma os dados json em objeto do javascript
    }).then(data => {            // Obtém os dados tratados e os imprimi no console.log
        console.log(data);
    });
//---------

// Quando a promessa for comprida ai vai ser executado o 'then'
fetch('http://localhost/estudo_ajax/?m=buscarTodosClientes').then(response => {

    //Vamos verificar se há algum erro, ou seja, se o ResponseStatus da api é diferente de 200
    if(response.status != 200) 
    {
        //Mostrar mensagem de erro
        throw Error('Não foi possível obter o recurso pretendido'); // Esta Exception irá cair no catch
    }else{

        // transforma o json retornado em objeto
        // Ou se for uma lista de json então vai retornar uma lista de objetos
        return response.json();
    }
}).then(clientes => {
    console.log(clientes);
}).catch(erro => {  //catch => Para caso haja algum erro( ou Exception), ele possa tratar.
    console.log('Aconteceu um erro:'+erro.message);
}); 

// ================================================
// ENVIANDO DADOS VIA POST, NO FORMATO JSONS (informamos no cabeçalho que estamos enviando um json)
// ===============================================+
let nome = 'weslley';
let email = 'weslley@hotmail.com';

fetch('http://localhost/estudo_ajax/?m=cadastrarCliente',{
    
    //Definindo método de envio
    method: 'POST', 
    
    // Definindo os cabeçalhos
    headers: {      
        "Content-Type" : "application/json; Charset=utf-8"
    },
    //Definindo o corpo(body) da requisição
    body: JSON.stringify({ //transforma um objeto do javascript, em uma string de formato JSON
        nome,
        email
    })

}).then(response => {

    if(response == 200)
    {
        return response.json();
    }else {
        throw Error('Ocorreu um erro ao cadastrar cliente');
    }

}).then(data => { //Caso a inserção for bem sucedida
    console.log('Usuário cadastrado com sucesso!');

}).catch(erro => { //Tratando erros
    console.log(erro.message);
})