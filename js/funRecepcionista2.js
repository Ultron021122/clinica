const eliminar = (id) =>{
    Swal.fire({
    title: 'Estas seguro de eliminar el registro',
    text: "Ya no se podrá recuperar el registro",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            var url = "./model/consultasRecepcionista.php";
            var formdata = new FormData();
            formdata.append('tipo_operacion', 'eliminar');
            formdata.append('id', id);
            fetch(url, {
                method: 'post',
                body: formdata
            }).then(data => data.json())
            .then(data => {
                console.log('Success:', data)
                pintar_tabla_resultados(data);
                Swal.fire(
                'Eliminado', 
                'El registro se elimino correctamente.',
                'success'
                )
            })
            .catch(error => console.error('Error:', error));
           
        }
    })
}

const pintar_tabla_resultados = (data) =>{
    let tab_datos = document.querySelector("#tabla-recepcionista");
    tab_datos.innerHTML = "";
    for(let item of data){
        tab_datos.innerHTML +=`
        <table class="table table-striped table-hover table-light text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col"><h5>Núm.</h5></th>
                    <th scope="col"><h5>CURP</h5></th>
                    <th scope="col"><h5>Nombre</h5></th>
                    <th scope="col"><h5>Correo electrónico</h5></th>
                    <th scope="col"><h5>Fecha de contratación</h5></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>${item.ID}</td>
                <td>${item.CURP}</td>
                <td>${item.Nombre}</td>
                <td>${item.Email}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="editar(${item.ID_user})">Editar</button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminar(${item.ID_user})">eliminar</button>
                </td>
                </tr>
            </tbody>
        </table>
        `;
    }
}

const editar = (id) => {
    //alert(id);
    var url = "./model/consultasRecepcionista.php";
    var formData = new FormData();
    formData.append('tipo_operacion','editar');
    formData.append('id',id);
    fetch(url,{
        method:'post',
        body:formData
    })
    .then(data => data.json())
    .then(data => {
        console.log('success', data);
        for(let item of data){
            var ID = item.ID;
            var Nombre = item.Nombre;
            var Apellidos = item.Apellidos;
            var Sexo = item.Sexo;
            var Fecha_nacimiento = item.Fecha_nacimiento;
            var Direccion = item.Direccion;
            var Telefono = item.Telefono;
            var Email = item.Email;
            var CURP = item.CURP;
            var Fecha_contratacion = item.Fecha_contratacion;
            if(Sexo == 'Masculino'){
                var sex = `
                <select name="Sexo" id="Sexo" class="form-control">
                    <option value="Masculino" selected>Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
                `;
            }else if(Sexo == 'Femenino'){
                var sex = `
                <select name="Sexo" id="Sexo" class="form-control">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino" selected>Femenino</option>
                </select>
                `;
            }
            
        }


        Swal.fire({
            title: 'Actualizar información',
            html: `
              <form id="update_form">
                <input type="text" value="update" name="tipo_operacion" hidden="true">
                <!-- ID del recepcionista -->
                <input type="number" value="${ID}" hidden="true" name="ID" class="form-control">
                <div class="form-group row">
                    <label for="Nombre" class="col-sm-3 col-form-label">Nombre</label>
                    <div class"col-sm-9">
                        <input type="text" value="${Nombre}" name="Nombre" id="Nombre" class="form-control">
                    </div>
                </div>
                <hr>
                <input type="text" value="${Apellidos}" name="Apellidos" class="form-control">
                <hr>
                ${sex}
              </form>  
            
            `,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
            }).then((result) => {
            if (result.value) {
                const datos = document.querySelector("#update_form");
                const datos_actualizar = new FormData(datos);
                var url = "./modelo/ejecutarconsultas.php";
                fetch(url, {
                    method: 'post',
                    body: datos_actualizar
                })
                .then(data => data.json())
                .then(data =>{ 
                    console.log('Success:', data);
                    pintar_tabla_resultados(data);
                    Swal.fire(
                        'Exito',
                        'Se actualizo con exito',
                        'success'
                    )
                      
                })
                .catch(function(error){
                    console.error('Error:', error)
                }); 

            }
        })
             
    })
    .catch(function (error){
        console.error('error',error);
    }); 
}