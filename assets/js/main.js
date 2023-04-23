window.onload = () => {
    clienteAcoes.listarClientes();
    clienteAcoes.cadastrarCliente();
}

const clienteAcoes = {

    cadastrarCliente : () => {

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

                // atualizar tabela de clientes
                clienteAcoes.listarClientes();

                // Limpando campos input
                event.target.nome.value = '';
                event.target.email.value = '';
                event.target.nome.focus(); //Colocando o cursor no input com name='nome'

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
    },

    switchAcao: async (idCliente) => {
        try {

            if(idCliente < 1)
            {
                throw new Error('Ocorreu um erro ao atualizar o status do cliente');
            }

            let response = await fetch(`./?m=alterarStatusCliente&idCliente=${idCliente}`);

            if (response.status != 200) {
                throw new Error('Ocorreu um erro ao atualizar o status do cliente');
            }

            let data = await response.json();

            if (data.status != 'success') {
                throw new Error('Ocorreu um erro ao atualizar o status do cliente');
            }

            clienteAcoes.listarClientes();

            //Mensagem de sucesso
            Toastify({
                text: data.message,
                duration: 1500,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }

            }).showToast();

            console.log(data);
        } catch (error) {

            //Mensagem de erro
            Toastify({
                text: 'Ocorreu um erro ao atualizar o status do cliente',
                duration: 1500,
                style: {
                    background: "linear-gradient(to right, #b43a3a,#fcb045)",
                }
            }).showToast();
        }
    },

    listarClientes: async () => {
        const tbodyTable = document.querySelector('#tbody-table');

        let resposta = await fetch('./?m=buscarTodosClientes');
        let data     = await resposta.json();

        tbodyTable.innerHTML = '';

        data.forEach(cliente => {
            let td = `<td>${cliente.id}</td>`;
            td += `<td>${cliente.nome}</td>`;
            td += `<td>${cliente.email}</td>`;
            td += `<td>${cliente.cliente_ativo}</td>`;

            let cliente_ativo = cliente.cliente_ativo ? 'checked' : '';

            td +=   `<td>
                        <label class="switch">
                            <input type="checkbox" ${cliente_ativo} onclick='clienteAcoes.switchAcao(${cliente.id});'>
                            <span class="slider round"></span>
                        </label>
                    </td>`;

            let tr = `<tr>${td}</tr>`;

            tbodyTable.innerHTML += tr;
        });
    }

}
