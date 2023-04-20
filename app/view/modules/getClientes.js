export const Cliente = {
    // BUSCA SOMENTE UM CLIENTE
    buscarCliente: async function(){
        let host = window.location.host;
        let pathName = window.location.pathname;

        let url = `https://www${$host}${pathName}`;

        const response = await fetch();
        const data = await response.json();
        return data;
    },
    // BUSCA MUITOS CLIENTES
    buscarClientes: () => {

    }
};