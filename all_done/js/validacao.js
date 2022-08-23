$(document).ready(function(){
    $("#formLogin").validate({
        rules:{
            email:{
                required: true,
                email: true
            },

            senha:{
                required: true,
                password: true,
                minlength: 6
            }
        }
    })
})

$(document).ready(function(){
    $("#formCadastro").validate({
        rules:{
            nome:{
                required:true,
                minlength:3
            },
            email:{
                required: true,
                email: true
            },
            senha:{
                required: true,
                minlength: 6
            }
        }
    })
})

$(document).ready(function(){
    $("#formAtividades").validate({
        rules:{
            tipo_atividade:{
                required: true
            },

            cargaH:{
                required: true,
                number:true,
                min: function(){
                    return $('#tipo_atividade').find(':selected').data('min');
                },
                max: function(){
                    return $('#tipo_atividade').find(':selected').data('max');
                },
                remote:{
                    url:'limiteCargaH.php',
                    type: 'post' ,
                    data: {
                        id_tipo_atividade: function(){
                            return $('#tipo_atividade').find(':selected').val();
                        },
                        limite: function(){
                            return $('#tipo_atividade').find(':selected').data('max');
                        },
                    }
                },
            },

            desc:{
                required: true,
            },

            mecanismo:{
                url: true
            },

            certif:{
                required: true,
                extension:"pdf"
            }
        },

    })
})

$(document).ready(function(){
    $("#formAtividadesEdita").validate({
        rules:{
            tipo_atividade:{
                required: true
            },

            cargaH:{
                required: true,
                number:true,
                min: function(){
                    return $('#tipo_atividade').find(':selected').data('min');
                },
                max: function(){
                    return $('#tipo_atividade').find(':selected').data('max');
                },
            },

            desc:{
                required: true,
            },

            mecanismo:{
                url: true
            },

            certif:{
                extension:"pdf"
            }
        },
    })
})

$(document).ready(function(){
    $("#formCurriculo").validate({
        rules:{
            curso:{
                required:true
            },
            curriculo:{
                required:true
            },
            dt_inicio:{
                required:true,
                date:true
            },
            dt_termino:{
                required: true,
                date: true
            },
        }
    })
})

$(document).ready(function(){
    $("#tipoAtividadeForm").validate({
        rules:{
            tipo_atividade:{
                required:true
            },
            hora_max:{
                required:true,
                number:true
            },
            hora_min:{
                required: true,
                number: true
            },
        }
    })
})

