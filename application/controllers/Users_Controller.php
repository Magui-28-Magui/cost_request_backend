<?php

include 'Json_controller.php';

class Users_Controller extends Json_Controller {


        function __construct(){
		parent::__construct();
                
        }
        

        public function index()
        {
                echo "This is my first controller";                
        }


        public function insert()
        {
                $this->load->model('user');
                $this->form_validation->set_data( $this->input->post() );

                //I need to make a validation...is_unique[users.email]|
                $this->form_validation->set_rules('email', 'Email', 'required|max_length[320]|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required|max_length[255]');
                $this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[64]');
                $this->form_validation->set_rules('lastname', 'Lastname', 'required|max_length[64]');
                $this->form_validation->set_rules('employee_number', 'Employee Number', 'required|numeric');
                $this->form_validation->set_rules('department_id', 'Department', 'numeric');
                $this->form_validation->set_rules('birthday', 'Birthday', 'required');
                $this->form_validation->set_rules('areacode', 'Area Code', 'required|max_length[5]');
                $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[25]');
                $this->form_validation->set_rules('user_level', 'User Level', 'required|is_natural');
                $this->form_validation->set_rules('photo', 'Photo', 'max_length[255]');
                $this->form_validation->set_rules('locked', 'Locked', 'required|is_natural');
                $this->form_validation->set_rules('suspend', 'Suspend', 'required|is_natural');
                $this->form_validation->set_rules('active', 'Active', 'required|is_natural');


                if ($this->form_validation->run() == FALSE)
                {
                        $errors = $this->get_validation_errors(  $this->form_validation->getFieldsArray() );
                        $this->ResponseFail($errors);
                }
                else
                {
                        $this->user->email    = $this->input->post('email'); // please read the below note
                        $this->user->password_hash  = $password_hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                        $this->user->firstname = $this->input->post('firstname');
                        $this->user->lastname = $this->input->post('lastname');

                        $this->user->employee_number = $this->input->post('employee_number');
                        
                        $this->user->department_id = $this->input->post('department_id');
                        
                        $this->user->birthday = $this->input->post('birthday');
                        $this->user->areacode = $this->input->post('areacode'); 
                        $this->user->phone = $this->input->post('phone');
                        $this->user->user_level = $this->input->post('user_level');
                        $this->user->photo = $this->input->post('photo');
                        $this->user->locked = $this->input->post('locked'); 
                        $this->user->suspend = $this->input->post('suspend'); 
                        $this->user->active = $this->input->post('active');

                        //$this->ResponseOk($data);
                        $this->user->register();
                        $this->ResponseOk($this->user);
                }
        }

        


}       