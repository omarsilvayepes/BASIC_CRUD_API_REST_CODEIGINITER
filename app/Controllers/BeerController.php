<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;


class BeerController extends ResourceController{

    protected $modelName = 'App\Models\BeerModel';
    protected $format    = 'json';

    public function index()
    {
        $data=$this->model->findAll();// find how make try catch???
        return $this->genericResponse($data,"",200);
    }

    private function genericResponse($data,$messageStatus,$codeStatus){

        if($codeStatus==200){
            return $this->respond(array("data"=>$data,"code"=>$codeStatus));
        }
        else{
            return $this->respond(array("message"=>$messageStatus,"code"=>$codeStatus));

        }

    }

}