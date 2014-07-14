<?php
class product extends MY_Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {
        $this->loadView("product/listproduct");
    }
    public function insert()
    {
        
        $data['infoProduct'] = array("4ewqe","adasd","dá");
        $this->loadView("product/insertproduct",$data);
    }
    public function update()
    {
        $this->loadView("product/updateproduct");
    }
}