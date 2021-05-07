function cargarInfo(select,valor,tiempo=500){
    $(document).ready(function(){
        setTimeout(function(){
            $(select).val(valor);
        },tiempo);
    })
}