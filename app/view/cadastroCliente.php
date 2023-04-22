<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
    <div class="container-fluid mt-3">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Cadastrar Cliente
        </button>
    
        <!-- Begin Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./?m=cadastrarCliente" method="post" id="formCadastro">
                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Nome: </label>
                                <input type="text" name="nome" id="id_campo_nome" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">E-mail: </label>
                                <input type="text" name="email" class="form-control">
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Cadastrar</button>                             
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        const formCadastro = document.querySelector('#formCadastro');

        formCadastro.addEventListener('submit', async (event) => {

            event.preventDefault();

            try {
                //Enviando dados para cadastro de um cliente cliente
                const resposta = await fetch('./?m=cadastrarCliente', {
                    method: "POST",
                    body: new FormData(formCadastro)
                });

                if (resposta.status != 200) {
                    throw new Error('Ocorreu um erro ao cadastrar cliente!');
                }

                const data = await resposta.json();

                if (data.status != 'success') {
                    throw new Error(data.message);
                }

                // Limpando campos input
                event.target.nome.value = '';
                event.target.email.value = '';

                //Mensagem de sucesso
                Toastify({
                    text: data.message,
                    duration: 1500,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }

                }).showToast();

            } catch (error) {
                //Mensagem de erro
                Toastify({
                    text: error.message,
                    duration: 1500,
                    style: {
                        background: "linear-gradient(to right, #b43a3a,#fcb045)",
                    }
                }).showToast();
            }
        });
    </script>
</body>

</html>