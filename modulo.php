<?php
include './Service/moduloService.php';


$accion="Agregar";
$nombre="";
$genero="";
$plataforma="";
$precio="";   
$codVideojuego=""; 
$codigo="";
$hidden="hidden";                      
//echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
//echo "Información del host: " . mysqli_get_host_info($conection) . PHP_EOL;
if (isset($_POST["nombre"])&&isset($_POST["codigo"])&&$_POST["accion"]=="Agregar")
{
    insertModulo($_POST["nombre"],$_POST["codigo"]);
    
    
}
else if (isset($_POST["nombre"])&&isset($_POST["codigo"])&&$_POST["accion"]=="Modificar"){

    modifyModulo($_POST["nombre"],$_POST["codigo"]);
}
if(isset($_GET["update"]))
{
    $result = findModuloByCod($_GET["update"]);
    if ($result->num_rows > 0) {
        $row1=$result->fetch_assoc();
        $nombre=$row1["NOMBRE"];
        $codigo=$row1["COD_MODULO"];
        $accion="Modificar";
        $hidden="";
    }
}
if(isset($_GET["delete"]))
{
    deactivateModulo('INA',trim($_GET["delete"]," "));
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CRUD PHP MONTERO ERICK</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Base de datos Videojuegos</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#lista">Lista de videojuegos</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#insertar"><?php echo $accion ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <!-- Lista de videojuegos-->
        <section class="about-section text-center" id="lista">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-white mb-4">Lista de Modulos</h2>
                        <table class="table text-white-50 text-center table-bordered ">
                            <tr>
                                <td>Codigo</td>
                                <td>Nombre</td>
                                <td>Estado</td>
                                <td>Modificar</td>
                                <td>Eliminar</td>
                            </tr>
                            <?php 
                        $result = findModulo();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                ?>
                            <tr>
                                <td><?php echo $row['COD_MODULO']; ?></td>
                                <td><?php echo $row['NOMBRE']; ?></td>
                                <td><?php echo $row['ESTADO']; ?></td>
                                <td><a href="modulo.php?update= <?php echo $row["COD_MODULO"];?>#insertar"><img class="img-small" src="assets/img/update.png" style="width:25px;height:25px;" alt="" /></a></td>
                                <td><a href="modulo.php?delete= <?php echo $row["COD_MODULO"];?>"><img class="img-small" src="assets/img/delete.png" style="width:25px;height:25px;" alt="" /></a></td>
                            </tr>
                            <?php }
                            }?>
                        </table>
                    </div>
                </div>
                <img class="img-small" src="assets/img/ipad.png" alt="" />
            </div>
        </section>
        <!-- Projects-->
        <section class="projects-section bg-light" id="insertar">
            <div class="container">
                <!-- Featured Project Row-->
                <div class="row align-items-left no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/videogame.png" style="width:512px;height:512px;" alt="" /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Registro de modulos</h4>
                            
                            <form name="forma" method="post" class="form" action="/CORRECCION/modulo.php">
                                <input type="hidden" name="codVideojuego" value="<?php echo $codVideojuego ?>">
                                <label for="nombre">Nombre:</label><br>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>
                                <?php if ($codigo!="")
                                {
                                    $codigo=$row['COD_MODULO'] + 1;   
                                }?>
                                <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>" required pattern="[0-9.0]+"><br><br>
                                <input type="submit" name="accion" value="<?php echo $accion ?>">
                                <input type="button" name="cancelar" value="Cancelar" visibility="<?php echo $hidden?>" onclick="document.location='modulo.php'">
                            </form> 

                        </div>
                    </div>
                </div>
                
        <form>


        </form>
        <!-- Contact-->
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © Your Website 2020</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
