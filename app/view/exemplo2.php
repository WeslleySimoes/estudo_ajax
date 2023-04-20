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

        let textoAqui = document.querySelector('#textoAqui');

        // Quando a promessa for comprida ai vai ser executado o 'then'
        fetch('http://localhost/estudo_ajax/?m=buscarTodosClientes').then(response => {

            if(response.status != 200)
            {
                //Mostrar mensagem de erro
            }else{
                
                // transforma o json retornado em objeto
                // Ou se for uma lista de json então vai retornar uma lista de objetos
                return response.json();
            }
            
        }).then(clientes => {

            // ----- CREATE TABLE -------
            let elementoTable = document.createElement('table');
            
            // ----- TABLE HEADER -------
            let trHeader = document.createElement('tr');
            
            let thHeaderNome = document.createElement('th');
            thHeaderNome.textContent = 'Nome';

            let thHeaderSexo = document.createElement('th');
            thHeaderSexo.textContent = 'Sexo';

            trHeader.appendChild(thHeaderNome);
            trHeader.appendChild(thHeaderSexo);

            elementoTable.appendChild(trHeader);

            // ----- TABLE BODY -------
            
            clientes.forEach(cliente => {
                
                let trBody = document.createElement('tr');

                let tdBodyNome = document.createElement('td');
                let tdBodySexo = document.createElement('td');

                tdBodyNome.textContent = cliente.nome;
                tdBodySexo.textContent = cliente.sexo;

                trBody.appendChild(tdBodyNome);
                trBody.appendChild(tdBodySexo);
                
                elementoTable.appendChild(trBody);
            });

            // ADICIONANDO A TABLE DEPOIS DA TAGLE '<p>'
            textoAqui.insertAdjacentElement('afterend',elementoTable);

            console.log(clientes);
        }).catch(erro => {  //catch => Para caso haja algum erro, ele possa tratar.
            console.log('Aconteceu um erro: '+erro.message+'| Response: '+erro.response);
        }); 

    </script>
</body> 
</html>