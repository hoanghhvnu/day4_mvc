<?php
class user extends MY_Controller
{
    protected $_error = array();
    public function __construct()
    {
       $this->loadModel("user_model");
    }
    public function index()
    {
        $data = $this->model->listUser();
        /*$data['listUser'] = $this->model->listUser();
        echo "<pre>";
        print_r($data);*/
        $this->loadView("user/listuser",$data);
    }
    public function insert()
    {
        $params = $_REQUEST;
        // echo "<pre>";
        // print_r($params);
        // echo $_SERVER["SCRIPT_NAME"];
        if(isset($_POST['btnok'])){
            if($this->checkData($params)){
                $userInsert = array(
                                "username"=>$params['txtname'],
                                "email"=>$params['txtemail'],
                                "address"=>$params['txtaddress'],
                                "phone"=>$params['txtphone'],
                                "gender"=>$params['gender']
                              );
                $this->model->insertUser($userInsert);
                header("location:index.php?module=admin&controller=user&action=index");
            }
        }      
        
        $data = $this->_error;  
        $data['title'] = "Them user";

        $this->loadView("user/insertuser",$data);
    }
    
    public function delete()
    {
        $id = $_GET['id'];
        $this->model->deleteUser($id);
        header("location:index.php?module=admin&controller=user&action=index");
    }

    public function update(){
        $params = $_REQUEST;
        $id = $params['id'];
        if(isset($_POST['btnok'])){
            if($this->checkData($params)){
                $userUpdate = array(
                                "username"=>$params['txtname'],
                                "email"=>$params['txtemail'],
                                "address"=>$params['txtaddress'],
                                "phone"=>$params['txtphone'],
                                "gender"=>$params['gender']
                              );
                // echo "mang userUpdate <pre>";
                // print_r($userUpdate);
                $this->model->updateUser($userUpdate,$id);
                header("location:index.php?module=admin&controller=user&action=index");
            }
        }      
        
        $data = $this->_error;  
        $data['title'] = "Them user";

        $data['cur_data'] = $this->model->getUser($id);
        /*echo "<pre>";
        print_r($data);*/

        $this->loadView("user/updateuser",$data);
    }
    private function checkData($params)
    {
        $flag = true;
        if(!isset($params['txtname']) || $params['txtname'] == ""){
            $this->_error['errorName'] = "Vui long nhap ten user"; 
            $flag = false;
        }

        if(!isset($params['txtemail']) || $params['txtemail'] == ""){
            $this->_error['errorEmail'] = "Vui long nhap email"; 
            $flag = false;
        }

        if(!isset($params['txtaddress']) || $params['txtaddress'] == ""){
            $this->_error['errorAddress'] = "Vui long nhap dia chi"; 
            $flag = false;
        }

        if(!isset($params['txtphone']) || $params['txtphone'] == ""){
            $this->_error['errorPhone'] = "Vui long nhap SDT"; 
            $flag = false;
        }

        if(!isset($params['gender']) || $params['gender'] == ""){
            $this->_error['errorGender'] = "Vui long chon gioi tinh"; 
            $flag = false;
        }
        return $flag;
    }
}