<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>UPDATE</title>
    </head>
    
    <body>
        <h4>Update</h4>
       <form action="./controller_update.php">
        Id:<br>
            <?php echo $libro->getId()?>
            <input type="hidden" name="id" value="<?php echo $libro->getId()?>">
            <br> 
        Título:<br>
            <input type="text" name="titulo" value="<?php echo $libro->getTitulo()?>">
            <br>
        Autor:<br>
        <input type="text" name="autor" value="<?php echo $libro->getAutor()?>">
         <br>
        Número de páginas:<br>
        <input type="text" name="numPag" value="<?php echo $libro->getNumPag()?>">
        <br>
        Editorial (insert id):<br>
        <input type="text" name="editorial" value="<?php echo $libro->getIdEditorial()?>">
        <br>
        <br>
  <input type="submit" value="Update">
</form> 
    </body>
</html>
