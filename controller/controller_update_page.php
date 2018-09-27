<?php

include_once ("../model/libro_class.php");
include_once ("../model/libro_model.php");

$id=filter_input(INPUT_GET,"idLibro");
$libro= new libro_model();
$libro->setId($id);
$libro->fillData();


include_once("../view/view_update_page.php");
