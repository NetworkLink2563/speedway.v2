<?php
function BasicAuth()
{
        $username = 'kOK24RIo625gOSCzPFK5cg==';
        $password = 'ymfqgoZg6BmJatEcSO7bNw==';   
        $ret=false;
        if(($_SERVER['PHP_AUTH_USER'] == $username)||$_SERVER['PHP_AUTH_PW']== $password )
        {
            $ret=true;
        }
        return $ret;
}
if(BasicAuth()!=true){
       echo "Error_Login";
       exit();
}  
?>

