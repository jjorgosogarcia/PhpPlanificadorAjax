<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="../css/vendor/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../dist/sweetalert.css">
        <link rel="stylesheet" href="../css/estilo.css">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
         
        
        <div class="container">
            
            <div id="divLogin">
	<section id="content">
		<form action="">
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" required="" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" />
			</div>
			<div>
                            <input type="button" id="btlogin2" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			
		</div><!-- button -->
	</section><!-- content -->
            </div>

            <div class="row ocultar" id="divRespuesta">
                <h1 id="bienvenida"></h1>
                <div id="botones">
                <button id="botonInsertarDialog" type="button" class="btn btn-info btn-lg ocultar" data-toggle="modal" data-target="#formularioInsertar">Insertar usuario</button>
                <button id="btlogout" type="button" class="btn btn-info btn-lg" data-target="#formularioInsertar">Cerrar sesión</button>
                </div>
            </div>

            <div class="modal fade modal-form" id="formularioInsertar" role="dialog">
                <div class="modal-dialog">       
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <form id="formInsertar" >
                                Usuario
                                <input type="text" id="Usuario" value="" /><hr>
                                Password
                                <input type="password" id="Password" value="" /><hr>
                                Nombre
                                <input type="text" id="Nombre" value="" /><hr>
                                Apellidos
                                <input type="text" id="Apellidos" value="" /><hr>
                                Departamento
                                <input type="text" id="Departamento" value="" /><hr>
                                <input type="hidden" id="ID" value="" /><hr>
                            </form>
                        </div>
                        <div id="mensajeInsertar" ></div>
                        <div class="modal-footer">
                            <button id="btInsertar" type="button" class="btn btn-default" >Insert</button>
                            <!--<button id="btEditar" type="button" class="btn btn-default" >Edit</button>-->
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin dialogos -->

            <div class="divPlanificador row ocultar" id="divPlanificador">
                <table class="tabla" id="tabla1">
                    <tr>
                        <th></th>
                        <th id="lunes">Lunes</th>
                        <th id="martes">Martes</th>
                        <th id="miercoles">Miercoles</th>
                        <th id="jueves">Jueves</th>
                        <th id="viernes">Viernes</th>
                        <th id="sabado">Sabado</th>
                    </tr>
                    <tr>
                        <th id="8">8:15</th>
                        <td id="l8"></td>
                        <td id="m8"></td>
                        <td id="mx8"></td>
                        <td id="j8"></td>
                        <td id="v8"></td>
                        <td id="s8"></td>
                    </tr>
                    <tr>
                        <th id="9">9:15</th>
                        <td id="l9"></td>
                        <td id="m9"></td>
                        <td id="mx9"></td>
                        <td id="j9"></td>
                        <td id="v9"></td>
                        <td id="s9"></td>
                    </tr>
                    <tr>
                        <th id="10">10:15</th>
                        <td id="l10"></td>
                        <td id="m10"></td>
                        <td id="mx10"></td>
                        <td id="j10"></td>
                        <td id="v10"></td>
                        <td id="s10"></td>
                    </tr>
                    <tr>
                        <th id="11">11:15</th>
                        <td id="l11"></td>
                        <td id="m11"></td>
                        <td id="mx11"></td>
                        <td id="j11"></td>
                        <td id="v11"></td>
                        <td id="s11"></td>
                    </tr>
                    <tr>
                        <th id="12">12:15</th>
                        <td id="l12"></td>
                        <td id="m12"></td>
                        <td id="mx12"></td>
                        <td id="j12"></td>
                        <td id="v12"></td>
                        <td id="s12"></td>
                    </tr>
                    <tr>
                        <th id="13">13:15</th>
                        <td id="l13"></td>
                        <td id="m13"></td>
                        <td id="mx13"></td>
                        <td id="j13"></td>
                        <td id="v13"></td>
                        <td id="s13"></td>
                    </tr>
                    <tr>
                        <th id="14">14:15</th>
                        <td id="l14"></td>
                        <td id="m14"></td>
                        <td id="mx14"></td>
                        <td id="j14"></td>
                        <td id="v14"></td>
                        <td id="s14"></td>
                    </tr>
                <!--    <tr>
                        <th id="15">15</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="16">16</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="17">17</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="18">18</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="19">19</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="20">20</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="21">21</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th id="22">22</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                -->
                </table>
            </div>

        </div>
        <script src="../js/vendor/jquery-1.11.1.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="../js/app.js"></script>
        <!--<script src="../js/calendario.js"></script>-->
        <script src="../dist/sweetalert-dev.js"></script>
    </body>
</html>
<?php $bd->close(); ?>