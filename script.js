
$(document).ready(function(){
    $("table #cuerpo").on("click",".elimina", borrar);
    $("table #cuerpo").on("click",".editar", editar);
    $(".back").click(index);
    $(".mostrar").click(mostrar);
    
});

function borrar(){
    //alert($(this).parents('tr').attr('data-id'));
    $('#cuerpo').load('deleteUser.php',{id:$(this).parents('tr').attr('data-id')},function() {
    });
}
function index(){
    window.location.href = "index.php";
}
function mostrar(){
    window.location.href = "mostrar.php";
}

function editar(){
    
    $('#contenido').load('editInfo.php',{id:$(this).parents('tr').attr('data-id')},function() {
    });
    
}