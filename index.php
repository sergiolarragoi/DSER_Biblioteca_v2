<!DOCTYPE html>
<?php 
      include ("./model/libro_class.php");
      include ("./model/editorial_class.php");
      include ("./model/libro_model.php");
      include ("./model/editorial_model.php");
      include ("./controller/controller_index.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
       <title>Biblioteca</title>
</head>
<body>
<h2>Títulos biblioteca</h2>
<table name="tableBooks" border="1">
     <?php
        
        foreach ($listaLibros as $book)
        {       
     ?>
     	<tr>
               <td><?php echo $book->getId();?></td>
               <td><?php echo $book->getTitulo();?></td>
               <td><?php echo $book->getAutor();?></td>
               <td><?php echo $book->getnumPag();?></td>
               <td><?php echo $book->getIdEditorial();?></td>
               <td><?php echo $book->getObjectEditorial()->getNOmbreEditorial();?></td>
               <td><?php echo $book->getObjectEditorial()->getCiudad();?></td>
               <td><a href="./controller/controller_delete.php?idLibro=<?php echo $book->getId()?> ">delete</a></td>
               <td><a href="./controller/controller_update_page.php?idLibro=<?php echo $book->getId()?> ">update</a></td>
               
	</tr>
        <?php } ?>
</table>
<br>
<a href="index_editorial.php">editorial</a><br>
<h4>Search by author:</h4>
<form action="./controller/controller_titulos_autor.php">
  Name:<br>
  <input type="text" name="author">
  <br>
  <input type="submit" value="ok">
</form> 

<h4>Add new book:</h4>
<form action="./controller/controller_insert.php">
  Título:<br>
  <input type="text" name="titulo">
  <br>
  Autor:<br>
  <input type="text" name="autor">
  <br>
  Número de páginas:<br>
  <input type="text" name="numPag">
  <br>
  Editorial (insert id):<br>
  <input type="text" name="editorial">
  <br>
  <br>
  <input type="submit" value="Insert">
</form> 

</body>
</html>