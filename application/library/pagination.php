<?php
class pagination{
    protected $_per_page;
    // protected _curPage = "";
    protected $_total;
    protected $_baseurl;

    public function setPer_page($value){
        return $this->_per_page = $value;
    }

    public function getPer_page(){
        return $this->_per_page;
    }

    public function setBaseurl($value){
        return $this->_baseurl = $value;
    }

    public function getBaseurl(){
        return $this->_baseurl;
    }
    

    public function setTotal($value){
        return $this->_total = $value;
    }

    public function getTotal(){
        return $this->_total;
    }

    public function createLink(){
        $totalPage = ceil($this->_total/$this->_per_page);
        $link = "";
        for ($i = 1; $i <= $totalPage; $i ++){
            $link .= "<a href='" . $this->_baseurl . "/" . $i . "'>" . $i ."</a>";
        } // end for $i
        return $link;
    }
} // end class pagination
// end file pagination.php

    