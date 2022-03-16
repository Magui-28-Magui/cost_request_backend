<?php

class User extends CI_Model {

    public $id;
    public $email;
    public $password_hash;
    public $firstname;
    public $lastname;
    public $employee_number;
    public $department_id;
    public $birthday;
    public $created_at;
    public $updated_at;
    public $areacode;
    public $phone;
    public $user_level;
    public $photo;
    public $locked;
    public $suspend;
    public $active;

    const TABLE = 'users';


    public function getByEmail($email)
    {
        $this->db->select('*');
        $this->db->from(self::TABLE);
        $this->db->where(['email'=>$email]);
        $query = $this->db->get();

        if ($query->result() != NULL)
        if( count ($query->result() > 0 ) )   
         return $query->result()[0];
        

        return false;
    }

    public function register()
    {
        /*  $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this); */

        $this->load->helper('date');
        $now = date('Y-m-d H:i:s', now());
        $this->created_at  = $now;
        $this->updated_at  = $now;
        $this->db->insert(self::TABLE, $this);
        $this->id = $this->db->insert_id();
    }


    public function update()
    {

    
    }

    public function delete()
    {

    }


    

}