function carregaCurriculo( id_curso ) {
    console.log(id_curso);
    $.ajax({
        method: "POST",
        url: "cadastro_aluno_form_options_curriculo_json.php",
        dateType:"json",
        data: { curso: id_curso }
    })
    .done(function( curriculos ) {
        var $select = $('#curriculo');
        $select.find('option').remove();
        $.each(JSON.parse(curriculos), function(key, curriculo) {
            $select.append(`<option value="${curriculo['id_curso_curriculo']}">${curriculo['curriculo']}</option>`);
        });
    });
}

function comentarioIndeferimento( id_atividade_comp ){

    var comentario=prompt('Qual a informação incorreta presente na atividade?');

    if(!(comentario.length === 0)){
        window.location.href = "../php/atividades_avaliacao_indeferida.php?id_atividade_comp="+id_atividade_comp+"&comentario="+comentario+"";
    }

}
