<!DOCTYPE html>
<?php 
      include ("./model/libro_class.php");
      include ("./model/editorial_class.php");
      include ("./model/libro_model.php");
      include ("./model/editorial_model.php");
      include ("./controller/controller_index_editorial.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
       <title>Biblioteca</title>
</head>
<body>
<h2>Editorialak </h2>
<table name="tableEditorial" border="1">
     <?php
     
        foreach ($listaEditoriales as $editorial)
        {       
     ?>
     	<tr>
               <td><?php echo $editorial->getIdEditorial();?></td>
               <td><?php echo $editorial->getNombreEditorial();?></td>
               <td><?php echo $editorial->getCiudad();?></td>
               <td>
               <?php
                $listaLibros=$editorial->getObjectLibros();
                               
                foreach ($listaLibros as $book)
                {
                                  
                    echo $book->getId();
                    echo "-->"; 
                    echo $book->getTitulo();
                    echo "-->";
                    echo $book->getAutor();
                    echo "-->";
                    echo $book->getnumPag();
                    echo "<br>";                 
                }          
              ?>
               </td>
                              
	</tr>
        <?php } ?>
</table>

<a href="index.php">libros</a>

</body>
</html>