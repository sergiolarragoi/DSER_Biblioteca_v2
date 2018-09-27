<?php

      include ("../model/libro_class.php");
      include ("../model/editorial_class.php");
      include ("../model/libro_model.php");
      include ("../model/editorial_model.php");
     
      $libro= new libro_model();
      $author=filter_input(INPUT_GET,"author");
      $libro->setListByAuthor($author); 
      $listaLibros=$libro->getList();
      unset ($libro);
      include ("../view/view_titulos_autor.php");