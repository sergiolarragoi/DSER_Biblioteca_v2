
<html>
    <head>
        <meta charset="UTF-8">
       <title>Biblioteca</title>
</head>
<body>
<h2>Titulos por autor</h2>
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
               
	</tr>
        <?php } ?>
</table>
<a href="../index.php">index</a>
</body>
</html>