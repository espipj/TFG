$(document).ready(function () {
    //alert("Documento listo!");

    $('.eliminar').click(function (e) {
        e.preventDefault();
        var boton=$(this);
        var row=$(this).parents('tr');
        var id=row.data('id');
        var form=$("#form-delete");
        var url = form.attr('action').replace(':ID_ELIMINAR',id);
        var data = form.serialize();
        //alert(url);
        var r= confirm("¿Estas seguro de que deseas borrar el registro?");
        if(r==true){
            $.post(url,data,function (result) {
                //alert(result);
                boton.addClass("disabled");
                row.find("td.vivo").attr('rel','0');
                row.fadeOut();
            }).fail(function () {
                alert('Se produjo un error al eliminar!');
                row.show();
            });

        }else {

        }
    });

});