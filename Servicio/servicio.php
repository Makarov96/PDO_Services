<?php
    require_once('../../meekrodb.2.3.class.php');
    require_once('../../conf.php');
    require_once('../lib/nusoap.php');

    $ns="urn:ObtenerXMLwsdl";
    $server = new soap_server();
    $server -> configureWSDL("ObtenerXML",$ns );
    $server->wsdl->schemaTargetNamespace=$ns;



    $server->register(
        'getId',
        array('id'=>'xsd:string'),
        array('return'=>'xsd:string'),
        $ns
    );

    $server->register(
        'setDelete',
        array('name'=>'xsd:string'),
        array('return'=>'xsd:string'),
        $ns
    );

    $server->register(
        'setInsert',
        array('correo'=>'xsd:string','password'=>'xsd:string','nombre'=>'xsd:string' ),
        array('return'=>'xsd:string'),
        $ns
    );

    function getId($id){
        $results = DB::query("SELECT*FROM tb_usuarios WHERE NOMBRECOMPLETO='$id'");
         return json_encode($results);
    }

    function setDelete($name){
        $results = DB::query("DELETE FROM tb_usuarios WHERE NOMBRECOMPLETO='$name'");
         return 'Se elimino exitosamente';
    }

    function setInsert($correo,$password,$nombre){
        $results = DB::query("INSERT INTO tb_usuarios(CORREOE,CLAVE,NOMBRECOMPLETO)
        VALUES ('$correo',MD5('$password'),'$nombre')");
         return 'Se inserto exitosamente';
    }

    function setUpdate($correo,$password,$nombre){
        $results = DB::query("INSERT INTO tb_usuarios(CORREOE,CLAVE,NOMBRECOMPLETO)
        VALUES ('$correo',MD5('$password'),'$nombre')");
         return 'Se inserto exitosamente';
    }


    if(!isset($HTTP_RAW_POST_DATA)){
        $HTTP_RAW_POST_DATA= file_get_contents('php://input');
       $server->service($HTTP_RAW_POST_DATA);
    }


?>