import {Clientes} from './app/view/modules/clientes.js';

let id_usuario = 0;

if(id_usuario > 0) {
    Clientes.obterCliente(id_usuario);
} else {
    Clientes.obterTodosClientes();
}