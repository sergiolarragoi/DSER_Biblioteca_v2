<?php

 include_once ("../model/libro_class.php");
 include_once ("../model/libro_model.php");

$id=filter_input(INPUT_GET,"idLibro");
echo $id;
$libro= new libro_model();
$libro->setId($id);

$libro->delete();
unset ($libro);
header('Location: ../index.php');
