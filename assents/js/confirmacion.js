function confirmacion(e){

    if(confirm("¿Desea eliminar el registro?")){
        return true;
    } else {
        e.preventDefault();
    }

}

let linkDelete = document.querySelectorAll(".edit-delete");

for (var i = 0; i < linkDelete.length; i++){
    linkDelete[i].addEventListener('click', confirmacion)
}