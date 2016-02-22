"use strict";
(function () {
    
    /**************************************************************/
    /***************DECLARACION DE VARIABLES***********************/
    /**************************************************************/  
    
    var misEventos = [];
    var login, clave, btlogin, btlogout, btInsertar, descripcionActividad,
            idEvento, descripcion, usuarioActual, btInsertarDialog, bienvenida, privilegio;
    btlogin = document.getElementById("btlogin2");
    btlogout = document.getElementById("btlogout");
    login = document.getElementById("username");
    clave = document.getElementById("password");
    var divLogin = document.getElementById("divLogin");
    var divRespuesta = document.getElementById("divRespuesta");
    var divPlanificador = document.getElementById("divPlanificador");
    btInsertar = document.getElementById("btInsertar");
    btInsertarDialog = document.getElementById("botonInsertarDialog");
    bienvenida = document.getElementById("bienvenida");
    //Usuario
    var usuario = document.getElementById("Usuario");
    var password = document.getElementById("Password");
    var nombre = document.getElementById("Nombre");
    var apellidos = document.getElementById("Apellidos");
    var departamento = document.getElementById("Departamento");

    //Eventos
    var tabla = document.getElementById('tabla1');
    var celdas = tabla.getElementsByTagName('td');

    /**************************************************************/
    /*****************************LOGIN*****************************/
    /***************************************************************/

    btlogin.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.login) {
                privilegio = respuesta.privilegio;
                divLogin.classList.add("ocultar");
                divRespuesta.classList.remove("ocultar");
                divPlanificador.classList.remove("ocultar");
                usuarioActual = login.value;
                if (privilegio == 1) {
                    btInsertarDialog.classList.remove("ocultar");
                } else {

                }
                bienvenida.textContent = usuarioActual;
                peticionEventos();
            } else {

            }

        };
        var ajax = new Ajax();
        var datoLogin = encodeURI(login.value);
        var datoClave = encodeURI(clave.value);
        ajax.setUrl("ajaxLogin.php?login=" + datoLogin + "&clave=" + datoClave);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }, false);

    btlogout.addEventListener("click", function () {
        privilegio = 0;
        var procesarRespuesta = function (respuesta) {
            if (!respuesta.login) {
                divLogin.classList.remove("ocultar");
                divRespuesta.classList.add("ocultar");
                divPlanificador.classList.add("ocultar");
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxLogout.php");
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }, false);

    var procesarRespuesta = function (respuesta) {
        if (respuesta.login) {
            privilegio = respuesta.privilegio;
            divLogin.classList.add("ocultar");
            divRespuesta.classList.remove("ocultar");
            divPlanificador.classList.remove("ocultar");
            if (privilegio == 1) {
                btInsertarDialog.classList.remove("ocultar");
            } else {

            }
            usuarioActual = respuesta.usuario;
            bienvenida.textContent = usuarioActual;
            peticionEventos();
        }
    };
    var ajax = new Ajax();
    ajax.setUrl("ajaxLogueado.php");
    ajax.setRespuesta(procesarRespuesta);
    ajax.doPeticion();

    /**************************************************************/
    /***************************USUARIOS***************************/
    /***************************************************************/

    btInsertar.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.insert > 0) {
                formularioInsertar.modal('toggle');
                var registro = {
                    "ID": respuesta.insert,
                    "Usuario": usuario.value,
                    "Password": password.value,
                    "Nombre": nombre.value,
                    "Apellidos": apellidos.value,
                    "Departamento": departamento.value
                };
                alert('si');
            } else {
                alert('no');
                mensajeInsertar.textContent = "Algo fallo al insertar al usuario";
            }
        };
        var ajax = new Ajax();
        var datoUsuario = encodeURI(usuario.value);
        var datoPassword = encodeURI(password.value);
        var datoNombre = encodeURI(nombre.value);
        var datoApellidos = encodeURI(apellidos.value);
        var datoDepartamento = encodeURI(departamento.value);
        ajax.setUrl("ajaxInsertUsuario.php?Usuario=" + datoUsuario + "&Password=" + datoPassword
                + "&Nombre=" + datoNombre + "&Apellidos=" + datoApellidos +
                "&Departamento=" + datoDepartamento);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    });

    /**************************************************************/
    /****************************EVENTOS***************************/
    /**************************************************************/

    /*************************MOSTRAR******************************/

    var peticionEventos = function () {
        var procesarRespuesta = function (respuesta) {
            //console.log(respuesta);
            procesar(respuesta);
            if (respuesta.eventos) {
                procesar(respuesta);
            } else {

            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxTareas.php");
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    };

    function procesar(json) {
        var ojson = json;
        for (var i = 0; i < ojson.eventos.length; i++) {
            var descripcion = ojson.eventos[i].descripcion;
            var usuario = ojson.eventos[i].profesor;
            document.getElementById(ojson.eventos[i].idevento).innerHTML = "Reservado por " + usuario + "<br/>" + descripcion;
            document.getElementById(ojson.eventos[i].idevento).classList.add("mostrar");
            document.getElementById(ojson.eventos[i].idevento).classList.add(usuario);
        }
    }


    /*************************MANEJO*******************************/

    celdas.addEventListener("click", manejadorClicTd(usuarioActual));

    function manejadorClicTd(nombre) {
        var motivo;
        var arrayCeldas;
        var tabla = document.getElementById('tabla1');
        var celdas = tabla.getElementsByTagName('td');
        var idCeldaSeleccionada;
        for (var i = 0; i < celdas.length; i++) {
            arrayCeldas = celdas[i];
            arrayCeldas.onclick = function () {
                var click = this;
                idCeldaSeleccionada = click.getAttribute('id');
                idEvento = idCeldaSeleccionada;
                if (click.className == 'mostrar ' + usuarioActual) {
                    sweetCancel(this);
                } else if ((click.className !== 'mostrar ' + usuarioActual) && (click.className !== "")) {
                    swal("Lo sentimos!", "No tienes permisos para borrar la tarea", "error");
                } else if (click.className == '') {
                    sweet(usuarioActual, this);
                }
                if ((privilegio == 1) && (click.className !== 'mostrar ' + usuarioActual) &&
                        (click.className !== "")) {
                    sweetCancel(this);
                }

            };
        }
    }

    function sweet(nombre, elemento) {
        swal({
            title: nombre,
            text: "Ingresa el motivo de la reserva:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Reservo para:"},
        function (inputValue) {
            if (inputValue === false)
                return false;
            if (inputValue === "") {
                swal.showInputError("No puedes dejar el motivo vacio");
                return false
            }
            swal("Genial!", "Su tarea ha sido guardada ", "success");
            elemento.innerHTML = "Reservado para: " + nombre + "<br>" + inputValue;
            elemento.classList.add("mostrar");
            descripcionActividad = inputValue;

            var procesarRespuesta = function (respuesta) {
                if (respuesta.insertEvento > 0) {
                    var registro = {
                        "ID": respuesta.insertEvento,
                        "Idevento": idEvento,
                        "Profesor": profesor.value,
                        "Descripcion": descripcionActividad
                    };
                    alert('si');
                } else {
                    alert('no');
                    mensajeInsertar.textContent = "Algo fallo al insertar la tarea";
                }
            };
            var ajax = new Ajax();
            var datoIdEvento = encodeURI(idEvento);
            var datoDescripcionActividad = encodeURI(descripcionActividad);
            ajax.setUrl("ajaxInsertEvento.php?Idevento=" + datoIdEvento +
                    "&Descripcion=" + datoDescripcionActividad);
            ajax.setRespuesta(procesarRespuesta);
            ajax.doPeticion();

        });

    }
    function sweetCancel(elemento) {
        swal({
            title: "Estás seguro?",
            text: "Eliminarás la tarea seleccionada",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Quiero borrarla!",
            cancelButtonText: "No, Ni hablar!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                swal("Eliminado!", "Has eliminado el evento.", "success");
                elemento.classList.remove("mostrar");
                elemento.innerHTML = "";
                var procesarRespuesta = function (respuesta) {
                    if (respuesta.delete > 0) {

                    } else {
                        alert("La tarea no se ha podido borrar.");
                    }
                };
                var ajax = new Ajax();
                var datoIdEvento = encodeURI(idEvento);
                var datoUsuario = encodeURI(usuarioActual);
                ajax.setUrl("ajaxDeleteEvent.php?Idevento=" + datoIdEvento + "&usuario=" + datoUsuario);
                ajax.setRespuesta(procesarRespuesta);
                ajax.doPeticion();
            } else {
                swal("Cancelado", "Tu tarea está a salvo", "error");
                elemento.classList.add("mostrar");
            }
        });
    }
})();