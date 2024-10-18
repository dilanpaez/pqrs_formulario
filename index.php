<?php
// include
require 'config/database.php';

 //1. BASE DE DATOS
 $db = conectarDB();

 //1a. 

 $consulta_tabla_depto = "SELECT * FROM departamento";
 $resultado_tabla_depto = mysqli_query($db, $consulta_tabla_depto);



 //2. creacion e INICIALIZANDO VARIABLES
 $clienteExiste = "0";

 $email = '';
 $nombre = '';
 $iddepto = 0;
 $nombreEmpleado = '';
 $mensaje = '';
 $fecha = '';

 //DECLARANDO ARREGLO VACIO DE ERRORES
    $errores = [];

  // aqui comienza el action, cuando el usuario da click 
 if( $_SERVER['REQUEST_METHOD'] ==='POST' )
  {
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];

    $iddepto = (int)$_POST['iddepto'];
    $mensaje = $_POST['mensaje'];
    $fecha = date("Y-m-d h:i:s");


    if(!$email) 
    {
        $errores [] = "Ingresa un correo Electrónico";
    } 


    if(!$nombre) 
    {
        $errores [] = "Ingresa un tu nombre";
    }

    if($iddepto === 0) 
    {
        $errores [] = "selecciona un departamento";
    }

    if(!$mensaje) {
        $errores [] = "debe redactar un mensaje";
    }

    if(empty($error))
    {
         //5.4.2 CONSULTADO AL CLIENTE
         $consultarCliente ="SELECT email FROM clientes WHERE email ='$email'";

         $resultado_existeCliente = mysqli_query($db, $consultarCliente);
        if($resultado_existeCliente === 0)
        {
            //5.4.2.2.1 INSERTAR CLIENTE A LA TABLA 'cliente'
            $queryClientes = "INSERT INTO clientes (email,nombre) VALUES('$email','$nombre')";
            $resultadoCliente = mysqli_query($db, $queryClientes);

            //5.4.2.2.2 VALIDO SI:CLIENTE INSERTADO =true

            if ($resultadoCliente) 
            {
                //5.4.3.3.3.1 VARIABLE DE CONTROL PARA MENSAJE DE BIENVENIDA 
                $resultado_existeCliente ="1";
                echo "Ahora usted ingreso a nuestra base de datos";
        
            }
            else
            {
                echo "lamentablemente no se pudo registrar"
            }
        }
    }
  }


//REQUIRIENDO EL CODIGO html DEL header---------------

require 'includes/header.php';


?>


<h1 class="encabezado-principal">FORMULARIO DE CONTACTO</h1>
    <div class="contenedor contenido-form">
        <form class="formulario" method="POST" 
        action="index.php">

        <?php foreach( $errores as $error ): ?>
            <div class="alerta-error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>





        <fieldset>
                <legend>informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="tu Nombre" id="nombre" name="nombre" 
                value="<?php echo $nombre; ?>">

                <label for="nombre">Correo Electrónico</label>
                <input type="email" placeholder="tu Email" id="email" name="email"  
                value="<?php echo $email; ?>">
        </fieldset>


        <fieldset>
                <legend>Informacion remitida</legend>

                <label for="iddepto">Departamento que recibe </label>

                <select id="iddepto" name="iddepto"  value="">
   
                     <option value="0">-- Seleccione --</option>

                     <?php
                              while ($row = mysqli_fetch_assoc
                              ($resultado_tabla_depto)):
                     ?>

  <option <?php echo $iddepto == $row['iddepto'] ? 'selected' : ''; ?> 
     value="<?php echo $row['iddepto'];?>">
    <?php echo $row['nombre depto']; ?>
  </option>

                </select>


                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje"><?php echo $mensaje; ?></textarea>

        </fieldset>


        <input class="boton" type="submit" value="Enviar">

        </form>    
    </div>         
</h1>                 
<?php

require 'includes/footer.php';


?>