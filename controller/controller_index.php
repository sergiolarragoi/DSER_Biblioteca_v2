<?php

$libro= new libro_model();
$libro->setList(); 
$listaLibros=$libro->getList();
unset ($libro);