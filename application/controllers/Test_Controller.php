<?php

include 'Json_controller.php';


class Test_Controller extends Json_Controller {


        //constructor
        function __construct(){
		    parent::__construct();    
        }
        
        public function index()
        {
                echo "This is the test controller";                
        }


   

      

}       