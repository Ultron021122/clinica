const formulariop = document.querySelector("#form");
formulariop.addEventListener('submit', (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('form'));
    let Curp                = datos.get('Curp');
    let Nombre              = datos.get('Nombre');
    let Apellidos           = datos.get('Apellidos');
    let Sexo                = datos.get('Sexo');
    let Fecha_nacimiento    = datos.get('Fecha_nacimiento');
    let Direccion           = datos.get('Direccion');
    let Telefono            = datos.get('Telefono');
    let Email               = datos.get('Email');
    let Password            = datos.get('Password');
    let Fecha_contratacion  = datos.get('Fecha_contratacion');
    let Especialidad        = datos.get('Especialidad');
    let Cedula              = datos.get('Cedula');
    let mensajes =  document.querySelector("#mensajes");
    mensajes.innerHTML = "";
    if (Curp == "") {
        let tipo_mensaje = "Debes de ingresar una CURP";
        error(tipo_mensaje);
        return false;
    } else if (Nombre == "") {
        let tipo_mensaje = "Debes de ingresar un Nombre";
        error(tipo_mensaje);
        return false;
    } else if(Apellidos == "") {
        let tipo_mensaje = "Debes de ingresar unos Apellidos";
        error(tipo_mensaje);
        return false;
    } else if(Password  == ""){
        let tipo_mensaje = "Debes de ingresar una Contraseña";
        error(tipo_mensaje);
        return false;
    } else if(Sexo  == ""){
        let tipo_mensaje = "Debes de seleccionar un tipo de sexo";
        error(tipo_mensaje);
        return false;
    } else if(Fecha_nacimiento == ""){
        let tipo_mensaje = "Debes de ingresar una fecha de nacimiento";
        error(tipo_mensaje);
        return false;
    } else if(Fecha_contratacion == ""){
        let tipo_mensaje = "Debes de ingresar una fecha de contratación";
        error(tipo_mensaje);
        return false;
    } else if(Direccion == ""){
        let tipo_mensaje = "Debes de ingresar una dirección";
        error(tipo_mensaje);
        return false;
    } else if(Telefono == ""){
        let tipo_mensaje = "Debes de ingresar un teléfono";
        error(tipo_mensaje);
        return false;
    } else if(Email == ""){
        let tipo_mensaje = "Debes de ingresar un correo electrónico";
        error(tipo_mensaje);
        return false;
    } else if(Especialidad == ""){
        let tipo_mensaje= "Debes de ingresar la especialidad";
        error(tipo_mensaje);
        return false;
    } else if(Cedula == ""){
        let tipo_mensaje= "Debes de ingresar la cédula medica";
        error(tipo_mensaje);
        return false;
    }
    var url = "./model/consultasMedico.php";
    fetch(url,{
        method:'post',
        body:datos
    })
    .then (data => data.json())
    .then (data => {
        console.log('success', data);
        if(data == "existe"){
            Swal.fire(
                '¡Error!',
                'El registro ya existe.',
                'error'
            )
        } else if (data == "ocurrio") {
            Swal.fire(
                '¡Ocurrio un error!',
                'No se pudo completar la tarea.',
                'error'
            )
        } else {
            Swal.fire(
                '¡Agregado!',
                'El registro ha sido guardado.',
                'success'
            )
        }
        formulariop.reset();

    })
    .catch(function(error){
        console.log('error',error);
    });
});

const error = (tipo_mensaje) => {
    mensajes.innerHTML +=`
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger d-flex" role="alert">
                <svg class="bi flex-shrink-0 me-3" width="42" height="42" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div class="">
                    <h4 class="alert-heading"> Error!!!</h4>
                    <p> *${tipo_mensaje}</p>
                </div>
            </div>
        </div>
    </div>
    `;
}
