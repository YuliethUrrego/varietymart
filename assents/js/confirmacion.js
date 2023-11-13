// Para eliminar un proveedor o producto
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


// Para cambiar rol de consulta a editor
function confirmacionConsulta(e){

    if(confirm("¿Está seguro que desea cambiar el rol del usuario a Editor?")){
        return true;
    } else {
        e.preventDefault();
    }

}

let linkConsulta = document.querySelectorAll(".consulta-button");

for (var i = 0; i < linkConsulta.length; i++){
    linkConsulta[i].addEventListener('click', confirmacionConsulta)
}


// Para cambiar rol de Editor a Consulta
function confirmacionEditor(e){

    if(confirm("¿Está seguro que desea cambiar el rol del usuario a Consulta?")){
        return true;
    } else {
        e.preventDefault();
    }

}

let linkEditor = document.querySelectorAll(".editor-button");

for (var i = 0; i < linkEditor.length; i++){
    linkEditor[i].addEventListener('click', confirmacionEditor)
}

// Para cambiar estado de activo a inactivo
function confirmacionActivo(e){

    if(confirm("¿Está seguro que desea inactivar el usuario?")){
        return true;
    } else {
        e.preventDefault();
    }

}

let linkActivo = document.querySelectorAll(".activo-button");

for (var i = 0; i < linkActivo.length; i++){
    linkActivo[i].addEventListener('click', confirmacionActivo)
}

// Para cambiar estado de activo a inactivo
function confirmacionInactivo(e){

    if(confirm("¿Está seguro que desea activar el usuario?")){
        return true;
    } else {
        e.preventDefault();
    }

}

let linkInactivo = document.querySelectorAll(".inactivo-button");

for (var i = 0; i < linkInactivo.length; i++){
    linkInactivo[i].addEventListener('click', confirmacionInactivo)
}