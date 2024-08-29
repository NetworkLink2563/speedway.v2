<?php
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if(count($data)>0){
            $Login=$data['Login'];
            $usr=$data['usr'];
            $pwd=$data['pwd'];
            $token=$data['token'];
            
            if($Login=="Login"){
             
                Login($usr, $pwd, $token);
            }
        }
        
}
?>