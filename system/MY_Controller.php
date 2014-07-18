<?php
class MY_Controller
{
    protected $model;
    protected $library;
    public function loadView($url,$data = array()){
        $module = isset($_REQUEST['module'])  && $_REQUEST['module'] != null ? $_REQUEST['module'] : "admin";
        $url = "application/modules/$module/views/$url.phtml";
        foreach ($data as $key => $value) {
            # code...
            $$key = $value;
        }
        require_once($url);
        
    }
    public function loadModel($model_name = "")
    {
        if($model_name == "")
        {
            return false;
        }
        $module = isset($_REQUEST['module'])  && $_REQUEST['module'] != null ? $_REQUEST['module'] : "admin";
        $url = "application/modules/$module/models/$model_name.php";
        require_once($url);
        $this->model = new $model_name;
    }

    public function loadLibrary($library_name = "")
    {
        if($library_name == "")
        {
            return false;
        }
        $url = "application/library/$library_name.php";
        require_once($url);
        $this->library = new $library_name;
    }

    public function baseurl($url){
        $str = "http://localhost/day4/day4_mvc" . $url;
        return $str;
    }

    public function redirect($url){
        header("location:{$url}");
    }
}