<?php
class user extends MY_Controller
{
    protected $_error = array();
    public function __construct()
    {
       // parent::__construct();
       $this->loadModel("user_model");
       $this->loadLibrary("pagination");
    }
    public function index()
    {
        $this->listuser();
    }

    public function listuser()
    {
        // $data = $this->model->listUser();
        $page = isset($_GET['id']) ? $_GET['id'] : 1;
        $per_page = 2;
        $total = $this->model->getTotalRecord();
        $base = $this->baseurl("/admin/user/listuser");

        $this->library->setPer_page($per_page);
        $this->library->setBaseurl($base);
        $this->library->setTotal($total);
        // echo "total: " . $total;
        $data['link'] = $this->library->createLink();

        $start = ($page - 1) * $per_page;
        $data['listUser'] = $this->model->getSeri($per_page,$start);
        // print_r($data);
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
                // echo $userInsert;
                $this->model->insertUser($userInsert);
                // header("location:index.php?module=admin&controller=user&action=index");
                // echo $this->baseurl("/admin/user/index");
                // header("location:/admin/user/index");
                $this->redirect($this->baseurl("/admin/user/index"));
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
        // header("location:index.php?module=admin&controller=user&action=index");
        // header("location:/admin/user/index");
        $this->redirect($this->baseurl("/admin/user/index"));
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
                // header("location:index.php?module=admin&controller=user&action=index");
                $this->redirect($this->baseurl("/admin/user/index"));
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