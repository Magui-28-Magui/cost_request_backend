<?php

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthenticationHook  {

    function __construct(){
          
    }
    
    /**
     * This function used to block the every request except allowed ip address
     */

    const SECRET_KEY = 'valores_martech_2022';

    function requestAuth(){
        
        /*if($_SERVER["REMOTE_ADDR"] != "49.248.51.230"){
            echo "not allowed";
            die;
        }*/
        $controller =& get_instance();
       
        if($controller->verify_authentication){
            
            $token = $this->getBearerToken();
            
            if($token)
            {
                try {

                    $decoded = JWT::decode($token, new Key(self::SECRET_KEY, 'HS256'));
                    $controller = $decoded;
                    // Access is granted. Add code of the operation here          
                }catch (Exception $e){
            
                    $response['success'] = 0;
                    $response['errors'] = ['auth'=>'Please login again!!, token expired'];
                    echo json_encode($response);
                    die;
                }

            } else
            {
                $response['success'] = 0;
                $response['errors'] = ['auth'=>'No token provided'];
                echo json_encode($response);
                die;
            }
        }

    }

    /** 
     * Get header Authorization
     * */
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

}
?>