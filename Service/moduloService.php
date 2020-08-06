<?php
include './Service/conection.php';


function insertFuncionalidad($nombre, $codigo, $descripcion, $url,$codModulo)
{
    $conection = getConection();
    $stmt = $conection->prepare("INSERT INTO SEG_FUNCIONALIDAD (COD_FUNCIONALIDAD, COD_MODULO, URL_PRINCIPAL,NOMBRE,DESCRIPCION) VALUES (?, ?, ?,?,?)");
    $stmt->bind_param("dssss", $codigo, $codModulo, $url, $nombre,$descripcion);
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
    $stmt->bind_param("ss", $crol, $cmodulo);
    $stmt->execute();
    $stmt->close();
}




function findModulo()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_MODULO WHERE ESTADO='ACT'");;
}
function findRol()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_ROL ");;
}
function findRolByCod($codigo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_ROL WHERE COD_ROL='".$codigo."'");;
}
function findRolModuloFilter($codigo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM ROL_MODULO rm, SEG_ROL sr, SEG_MODULO sm WHERE sm.ESTADO='ACT' AND rm.COD_ROL=sr.COD_ROL AND rm.COD_MODULO =sm.COD_MODULO AND sr.COD_ROL='".$codigo."'");;
}
function findRolModulo()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM ROL_MODULO rm, SEG_ROL sr, SEG_MODULO sm WHERE sm.ESTADO='ACT' AND rm.COD_ROL=sr.COD_ROL AND rm.COD_MODULO =sm.COD_MODULO");;
}

function findAllModulo()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_MODULO ");;
}

function findModuloByCod($codigo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_MODULO WHERE COD_MODULO=".$codigo);
}

function findFuncionalidad($codigo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_MODULO=".$codigo);
}
function findFuncionalidadByCod($codigo)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=".$codigo);
}
function findAllFuncionalidad()
{
    $conection = getConection();
    return $conection->query("SELECT * FROM SEG_FUNCIONALIDAD");
}







function modifyFuncionalidad($nombre, $codigo, $descripcion, $url,$codModulo)
{
    $conection = getConection();
    $stmt = $conection->prepare("update SEG_FUNCIONALIDAD set NOMBRE=?,  URL_PRINCIPAL=?,  DESCRIPCION=?, COD_MODULO=? WHERE COD_FUNCIONALIDAD=?");
    $stmt->bind_param("ssssd", $nombre, $url, $descripcion,$codModulo,$codigo);
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



function deleteRolModulo($codModulo,$codRol)
{
    $conection = getConection();
    $sql = "DELETE FROM ROL_MODULO WHERE COD_ROL='".$codRol."' AND COD_MODULO=".$codModulo;
    $conection->query($sql);
    $conection->close();
}
function deleteFuncionalidad($codFuncionalidad)
{
    $conection = getConection();
    $sql = "DELETE FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=".$codFuncionalidad;
    $conection->query($sql);
    $conection->close();
}
function findByCod($codVideojuego)
{
    $conection = getConection();
    return $conection->query("SELECT * FROM VIDEOJUEGO WHERE cod_videojuego=".$codVideojuego);;
}
?>


