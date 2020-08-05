<?php
include './Service/conection.php';

function insert($nombre, $genero, $plataforma, $precio)
{
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO videojuego (nombre, genero, plataforma,precio) VALUES (?, ?, ?,?)");
    $stmt->bind_param("sssd", $nombre, $genero, $plataforma, $precio);
    $stmt->execute();
    $stmt->close();
}
function insertModulo($nombre, $codigo)
{
    $estado='ACT';
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO SEG_MODULO (COD_MODULO, NOMBRE, ESTADO) VALUES (?,?,?)");
    $stmt->bind_param("sss", $codigo, $nombre, $estado);
    $stmt->execute();
    $stmt->close();
}
function insertRolModulo($cmodulo, $crol)
{
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO ROL_MODULO (COD_ROL, COD_MODULO) VALUES (?, ?)");
    $stmt->bind_param("ss", $cmodulo, $crol);
    $stmt->execute();
    $stmt->close();
}
function insertFuncionalidad($modulo, $nombre, $url, $descripcion)
{
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO seg_funcionalidad (nombre, genero, plataforma,precio) VALUES (?, ?, ?,?)");
    $stmt->bind_param("ssss", $modulo, $url, $nombre, $descripcion);
    $stmt->execute();
    $stmt->close();
}


function findAll()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM VIDEOJUEGO");;
}
function findModulo()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_MODULO WHERE ESTADO='ACT'");;
}

function findModuloByCod($codigo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_MODULO WHERE COD_MODULO=".$codigo);
}

function findSegRol()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM seg_rol");;
}
function findSegModuloPorRol($codRol)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM seg_modulo,rol_modulo WHERE SEG_MODULO.ESTADO=ACT AND seg_modulo.COD_MODULO=rol_modulo.COD_MODULO AND rol_modulo.COD_MODULO=".$codRol);;
}
function findSegModulo()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM seg_modulo");;
}
function findAllFuncionalidades()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM seg_funcionalidad");;
}
function findAllRolModulo()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM rol_modulo");;
}

function modify($nombre, $genero, $plataforma,$precio,$codVideojuego)
{
    $conection = getConection();
    $stmt = $conection->prepare("update videojuego set nombre=?,  genero=?,  plataforma=?, precio=? where cod_videojuego=?");
    $stmt->bind_param("ss", $nombre, $genero, $plataforma,$precio,$codVideojuego);
    $stmt->execute();
    $stmt->close();
}

function modifyModulo($nombre, $codigo)
{
    $conection = getConection();
    $stmt = $conection->prepare("update SEG_MODULO set NOMBRE=? where COD_MODULO=?");
    $stmt->bind_param("ss", $nombre, $codigo);
    $stmt->execute();
    $stmt->close();
}
function deactivateModulo($estado,$codigo)
{
    $conection = getConection();
    $stmt = $conection->prepare("update SEG_MODULO set ESTADO=? where COD_MODULO=?");
    $stmt->bind_param("ss", $estado, $codigo);
    $stmt->execute();
    $stmt->close();
}

function modifyRolModulo($codRol, $codModulo)
{
    $conection = getConection();
    $stmt = $conection->prepare("update ROL_MODULO set COD_ROL=?,  COD_MODULO=? where COD_ROL=? AND where COD_MODULO=?");
    $stmt->bind_param("ssss", $codRol, $codModulo, $codRol,$codModulo);
    $stmt->execute();
    $stmt->close();
}

function modifyFuncionalidad($codmodulo, $url, $nombre,$descripcion,$codFuncionalidad)
{
    $conection = getConection();
    $stmt = $conection->prepare("update  set COD_MODULO=?,  URL_PRINCIPAL=?,  NOMBRE=?, DESCRIPCION=? where COD_FUNCIONALIDAD=?");
    $stmt->bind_param("ss", $codmodulo, $url, $nombre,$descripcion,$codFuncionalidad);
    $stmt->execute();
    $stmt->close();
}
function remove($codVideojuego)
{
    $conection = getConection();
    $sql = "DELETE FROM videojuego WHERE cod_videojuego=".$codVideojuego;
    $conection->query($sql);
    $conection->close();
}
function removeRolModulo($codModulo,$codRol)
{
    $conection = getConection();
    $sql = "DELETE FROM ROL_MODULO WHERE COD_ROL=".$codRol."AND COD_MODULO=".codModulo;
    $conection->query($sql);
    $conection->close();
}
function removeFuncionalidad($codFuncionalidad)
{
    $conection = getConection();
    $sql = "DELETE FROM seg_funcionalidad WHERE COD_FUNCIONALIDAD=".$codFuncionalidad;
    $conection->query($sql);
    $conection->close();
}
function findByCod($codVideojuego)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM VIDEOJUEGO WHERE cod_videojuego=".$codVideojuego);;
}
?>


