/**
 * efeito alert
 */
$(function () {
    // pegar elemente com corpo da mensagem
    var corpo_alert = $("#alert-message");
 
    // verificar se o elemente esta presente na pagina
    if (corpo_alert.length)
        // gerar efeito para o elemento encontrado na pagina
        corpo_alert.fadeOut().fadeIn().fadeOut().fadeIn();
});

/**
 * mask input
 */
$(function (){
    // mascara para telefone: (xx) xxxx-xxxxx
    $("input#telefone, input#telefone2").mask("(99) 9999-9999?9");
    
    // mascara para CPF: xxx.xxx.xxx-xx
    $("input#cpf").mask("999.999.999-99");
   
});
