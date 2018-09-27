<?php
$editorialObject=new editorial_model();
$editorialObject->setList();
$listaEditoriales=$editorialObject->getList();
unset ($editorialObject);

