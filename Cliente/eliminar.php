<?php
   require_once('../lib/nusoap.php');

   $wsdl= 'http://localhost/Tarea_Cuatro_php/Servicios/Servicio/servicio.php';
   $client=new nusoap_client($wsdl,false);

   $err=$client->getError();
   if($err){
       echo '<h3>Se produjo un error en la construccion</h3>';
   }else{

    if(isset($_POST['submit'])){
        $data= $_POST['delete'];
        $parametros= array('name'=>$data);
        $respuesta= $client->call('setDelete',$parametros);
        print_r($respuesta);
        header('Location: cliente.html');
      }

   }
?>