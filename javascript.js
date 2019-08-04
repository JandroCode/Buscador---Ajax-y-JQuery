
$(buscar());

function buscar(consulta){
    $.ajax({
        type: "POST",
        url: "buscar.php",
        data: { consulta },
        dataType: "html",
        success: function (response) {
            $('#datos').html(response);
            
        }
    });
}

$(document).on("keyup","#buscador",function(){
    var resultadoBusqueda = $(this).val();

    if(resultadoBusqueda!=""){
        buscar(resultadoBusqueda);
    }
    else{
        buscar();
    }

});
