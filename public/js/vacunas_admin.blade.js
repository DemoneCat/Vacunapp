const url_detalles_vacuna = "{{route('vacuna.search')}}";
function detallesVacuna(id){
    fetch(url_detalles_vacuna + "?id="+id, {
        method: 'GET',
    }).then(res => res.json())
    .then(
        response => console.log(response)
    );
}
$(function(){

});
