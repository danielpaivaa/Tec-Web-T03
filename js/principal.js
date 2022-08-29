function deletarCliente(cod){

    if(confirm('Você tem certeza que deseja deletar este cliente?')){
        $.post("../include/deletarRegistros.php", 
        {
            idClienteDeletar:cod
        },
        function(valor){
            $("#mensagem").html(valor);
        }
        );
    }
}

function deletarAnimal(cod) {
    if(confirm('Você tem certeza que deseja deletar este animal?')){
        $.post("../include/deletarRegistros.php", 
        {
            idAnimalDeletar:cod
        },
        function(valor){
            $("#mensagem").html(valor);
        }
        );
    }
}

function deletarAgendamento(cod) {
    if(confirm('Você tem certeza que deseja deletar este agendamento?')){
        $.post("../include/deletarRegistros.php", 
        {
            idAgendamentoDeletar:cod
        },
        function(valor){
            $("#mensagem").html(valor);
        }
        );
    }
}

