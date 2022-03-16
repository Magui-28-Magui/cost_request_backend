<?php

class Json_Controller extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            
    }

    public $verify_authentication = TRUE;
    public $auth; //Array for data of authentication

    public function ResponseOk($data)
    {
        $response['success'] = '1';
        $response['data'] = $data;
        $this->Response($response, 200);
    }


    public function ResponseFail($errors)
    {
        $response['success'] = '0';
        $response['errors'] = $errors;
        $this->Response($response, 200);
    }

    public function Response($response,$http_code)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($http_code)
            ->set_output(json_encode( $response  ));
    }


    public function get_validation_errors($field_names){
 
        //$this->form_validation->set_rules($validation_rules); //through this statement rules are set
 
        $errors_array = array();//array is initialized
         
        foreach ($field_names as $field) {
            $error = $this->form_validation->error($field);
            //field has error?
            if (strlen($error)) 
            $errors_array[$field] = $error;
        }
 
        return $errors_array;
 
    }



}