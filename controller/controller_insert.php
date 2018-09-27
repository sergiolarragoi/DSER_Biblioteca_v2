<?php
 include_once ("../model/libro_class.php");
 include_once ("../model/libro_model.php");

$libro= new libro_model();
$libro->setTitulo(filter_input(INPUT_GET, 'titulo'));
$libro->setAutor(filter_input(INPUT_GET, 'autor'));
$libro->setNumPag(filter_input(INPUT_GET, 'numPag'));
$libro->setIdEditorial(filter_input(INPUT_GET,'editorial'));

$libro->insert();
unset($libro);
header('Location: ../index.php');
