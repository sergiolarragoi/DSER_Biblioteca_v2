<?php
include_once ("connect_data.php");  // klase honetan gordetzen dira datu basearen datuak. erabiltzailea...


class libro_model extends libro_class
{
    private $link;  // datu basera lotura - enlace a la bbdd
    private $list;  // datu basetik ekarritako datuak gordeko diren array-a 
    protected $objectEditorial;  //editorialaren datuak gordeko dira hemen objetu bezala
         
 public function getList() {
        return $this->list;
    }
    
 public function getObjectEditorial() 
 {
        return $this->objectEditorial;
 }

 public function OpenConnect()
    {
    $konDat=new connect_data();
    try
    {
         $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
         // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
         // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión. 
    }
    catch(Exception $e)
    {
    echo $e->getMessage();
    }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }                   
 
 public function CloseConnect()
 {
     //mysqli_close ($this->link);
     $this->link->close();
 }
 
 public function setList()
 {
   /*
  * gets from the ddbb all the books in the table
  */
        $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
        $sql = "CALL spAllBooks()"; // SQL sententzia - sentencia SQL
        $this->list = array(); // objetuaren list atributua array bezala deklaratzen da - 
                    //se declara como array el atributo list del objeto
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
                    // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $new=new self();
            $new->setId($row['id']);
            $new->setTitulo($row['titulo']);
            $new->setAutor($row['autor']);
            $new->setNumPag($row['numPag']);
            $new->setIdEditorial($row['idEditorial']);
            
            require_once ("editorial_model.php");
            $datoEditorial=new editorial_model(); 
            $new->objectEditorial=$datoEditorial->findIdEditorial($row['idEditorial']);
                                        // honek itzultzen digu editorialaren datua objetu baten.
            array_push($this->list, $new);  
        }
       mysqli_free_result($result); 
       unset($datoEditorial);
       $this->CloseConnect();
 }
 public function setListByAuthor($author)
 {/*
  * gets from the ddbb all the books from a certain writer
  */
        $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
                
        $sql = "CALL spBooksByAuthor('".$author."')"; // SQL sententzia - sentencia SQL
      
        $this->list = array(); // objetuaren list atributua array bezala deklaratzen da - 
                    //se declara como array el atributo list del objeto
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
                    // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $new=new self();
            $new->setId($row['id']);
            $new->setTitulo($row['titulo']);
            $new->setAutor($row['autor']);
            $new->setNumPag($row['numPag']);
            $new->setIdEditorial($row['idEditorial']);
            
            require_once ("editorial_model.php");
            /*
             * here we create an object of type editorial so with each book
             * we know also all the information about the editorial 
             */
            $datoEditorial=new editorial_model(); 
            $new->objectEditorial=$datoEditorial->findIdEditorial($row['idEditorial']);
                                        // honek itzultzen digu editorialaren datua objetu baten.
            array_push($this->list, $new);  
        }
       mysqli_free_result($result); 
       unset($datoEditorial);
       $this->CloseConnect();
 }
 public function insert()
 {
     /*
      * inserts a book in the database
      */
      $this->OpenConnect();  // konexio zabaldu  - abrir conexión     
      $titulo="'". $this->getTitulo()."'";
      $autor= "'".$this->getAutor()."'";
      $numPag= $this->getNumPag();
      $idEditorial= $this->getIdEditorial();
      $sql = "CALL spInsertLibro($titulo, $autor, $numPag,$idEditorial)";
      //echo $sql;
      $this->link->query($sql);   
      $this->CloseConnect();
 }
 
 public function delete()
 {
     /*
      * deletes a book 
      */
      $this->OpenConnect();
      
      $sql="CALL spDeleteBook(".$this->getId().")";
      $this->link->query($sql);
      $this->CloseConnect();
 }
 public function update()
 {/*
  * update
  */
      $this->OpenConnect();
      $titulo="'". $this->getTitulo()."'";
      $autor= "'".$this->getAutor()."'";
      $numPag= $this->getNumPag();
      $idEditorial= $this->getIdEditorial();
      $sql="CALL spUpdateBook(".$this->getId().",$titulo,$autor,$numPag,$idEditorial)";
      $this->link->query($sql);
      $this->CloseConnect();
      //var_dump($sql);
 }
 
 public function findLibroPorIdEditorial($idEditorial)
 {/*
  * returns a list with all the books (objects) edited by a given editorial.
  */
        $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
        $sql = "CALL spLibrosPorEditorial(".$idEditorial.")"; // SQL sententzia - sentencia SQL
        $this->list = array(); // objetuaren list atributua array bezala deklaratzen da - 
                    //se declara como array el atributo list del objeto
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
                    // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $new=new self();
            $new->setId($row['id']);
            $new->setTitulo($row['titulo']);
            $new->setAutor($row['autor']);
            $new->setNumPag($row['numPag']);
            $new->setIdEditorial($row['idEditorial']);
          
            array_push($this->list, $new);  
            
        }
       mysqli_free_result($result); 
       $this->CloseConnect();
       return $this->list;
 }

 public function fillData()
 {
     /*
      * when updating a book first of all, we have to charge a form knowing
      * only the id, so we use this function to get all the information
      * of the selected book.
      */
      $this->OpenConnect(); 
      $sql="CALL spLibrosById(".$this->getId().")";
  
      $result=$this->link->query($sql);
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
       {
        $this->setTitulo($row['titulo']);
        $this->setAutor($row['autor']);
        $this->setNumPag($row['numPag']);
        $this->setIdEditorial($row['idEditorial']);     
       }
      mysqli_free_result($result); 
      $this->CloseConnect();
 }
}