// ADICIONAR UMA CLASSE A UM ELEMENTO HTML
document.getElementById("MyElement").classList.add('MyClass');

// REMOVER UMA CLASSE DE UM ELEMENTO HTML
document.getElementById("MyElement").classList.remove('MyClass');

// VERIFICA SE UM ELEMENTO POSSUI UMA CLASSE ESPECIFICA, RETORNA TRUE OU FALSE;
document.getElementById("MyElement").classList.contains('MyClass');

// FICA ALTERNANDO ENTRE ADICIONAR E REMOVER UMA CLASSE EM UM ELEMENTO HTML
document.getElementById("MyElement").classList.toggle('MyClass');

//Definido uma classe para um elemento html, cuidado que ele limpa as classes e adiciona a que você esta atribuindo
document.getElementById("MyElement").className = "MyClass";

// Adicionando mais uma classe a um elemento html
document.getElementById("MyElement").className += " MyClass";

