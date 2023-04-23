export const teste = {
    msg:  () => {
        window.onload('Mensagem 1');
    },
    msg2: () => {
        teste.msg();
        window.alert('Mensagem 2');
    }
}