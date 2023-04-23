export default class Cliente
{
    constructor(){
        this.listarClientes();
    }

    static cadastrarCliente() {
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
                this.listarClientes();

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
    }

    static async switch_acao(idCliente){
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

            this.listarClientes();

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
    }

    static async listarClientes() {
        const tbodyTable = document.querySelector('#tbody-table');

        let resposta = await fetch('./?m=buscarTodosClientes');
        let data = await resposta.json();

        tbodyTable.innerHTML = '';

        data.forEach(cliente => {
            let td = `<td>${cliente.id}</td>`;
            td += `<td>${cliente.nome}</td>`;
            td += `<td>${cliente.email}</td>`;
            td += `<td>${cliente.cliente_ativo}</td>`;

            let cliente_ativo = cliente.cliente_ativo ? 'checked' : '';

            td +=   `<td>
                        <label class="switch">
                            <input type="checkbox" ${cliente_ativo} onclick='cliente.switch_acao(${cliente.id});'>
                            <span class="slider round"></span>
                        </label>
                    </td>`;

            let tr = `<tr>${td}</tr>`;

            tbodyTable.innerHTML += tr;
        });
    }
}