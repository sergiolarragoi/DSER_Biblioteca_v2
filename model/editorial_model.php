<?php

include_once ("connect_data.php");

class editorial_model extends editorial_class
{
    private $link;
    private $list;
    private $objectLibros =array(); // used to fill with all the books edited by the editorial
    
    
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
         mysqli_close ($this->link);
    }
 
    public function findIdEditorial($idEditorial)
    {
      /*
       * returns an object with all the information about a certain editorial
       */
        $this->OpenConnect();  
        $sql = "CALL spFindIdEditorial($idEditorial)";
               
        $result = $this->link->query($sql);    
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                
            $this->setIdEditorial($row['idEditorial']);
            $this->setNombreEditorial($row['nombreEditorial']);
            $this->setCiudad($row['ciudad']);  
         
        }
       mysqli_free_result($result); 
       $this->CloseConnect();
     
       return $this;
    }   
 
    public function setList()
    {
        /*
         * fills a list with all the editorials in the database
         */
        $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
        $sql = "CALL spAllEditorial()"; // SQL sententzia - sentencia SQL
        $this->list = array(); // objetuaren list atributua array bezala deklaratzen da - 
                    //se declara como array el atributo list del objeto
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
                    // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $new=new self();
            $new->setIdEditorial($row['idEditorial']);
            $new->setNombreEditorial($row['nombreEditorial']);
            $new->setCiudad($row['ciudad']);
                   
            require_once ("libro_model.php");
            /*
             * here we fill an array with all the books edited by the editorial,
             */
            $listaLibrosEditorial=new libro_model(); 
           
            $new->objectLibros=$listaLibrosEditorial->findLibroPorIdEditorial($row['idEditorial']);
                                        // honek itzultzen digu editorial bateko liburu guztien zerrenda
                                        // elementu bakoitza "libro objetu bat da"
          
            array_push($this->list, $new);  
        }
       mysqli_free_result($result); 
       unset($listaLibrosEditorial);
       $this->CloseConnect();
    }

    public function getObjectLibros() {
        return $this->objectLibros;
    }

    
    public function getList() {
        return $this->list;
    }
}
