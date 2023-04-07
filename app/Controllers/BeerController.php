<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BeerController extends ResourceController{

    protected $modelName = 'App\Models\BeerModel';
    protected $format    = 'json';

    public function index()
    {
        $data=$this->model->findAll();
        return $this->genericResponse($data,"",200);
    }

    public function getBeerById($id=null){

        if($id==null){
            return $this->genericResponse(null,"Cannot find id parameter",500);
        }

        $beerFetched=$this->model->find($id);

        if(!$beerFetched){
            return $this->genericResponse(null,"Beer dont find it",200);
        }

        return $this->genericResponse($beerFetched,"Beer fetched succesfully",200);

    }

    public function createBeer(){

/*         if($this->validate('beerValidation')){

        } */

     /*    $validation=\Config\Services::validation();
        return $this->genericResponse(null,$validation->getErrors(),400); */

                  // capture data from the body Request Post
                  $bodyRequest=[
                    'brand'=>$this->request->getPost('brand'),
                    'price'=>$this->request->getPost('price'),
                    'alcohol'=>$this->request->getPost('alcohol')
                ]; 
        
                  $id=$this->model->insert($bodyRequest);
        
                  $beerFetched=$this->model->find($id); 
        
                  return $this->genericResponse($beerFetched,"Beer Created succesfully",200);
    }

    public function updateBeer($id=null){

        $beerSearched=$this->model->find($id);

        if(!$beerSearched){
            return $this->genericResponse(null,"Beer does Not exist",204);
        }

        // capture data from the body Request Post
        $dataRequestUpdate=$this->request->getRawInput();

        $bodyRequest=[
            'brand'=>$dataRequestUpdate['brand'],
            'price'=>$dataRequestUpdate['price'],
            'alcohol'=>$dataRequestUpdate['alcohol']
        ]; 

          $this->model->update($id,$bodyRequest);

          $beerFetched=$this->model->find($id); 

          return $this->genericResponse($beerFetched,"Beer Update succesfully",200);

    }

    public function deleteBeer($id=null){

        $beerSearched=$this->model->find($id);

        if(!$beerSearched){
            return $this->genericResponse(null,"Beer does Not exist",204);
        }

        $this->model->delete($id);
        return $this->genericResponse("Beer $id Deleted Succesfully","Beer Deleted Succesfully",200);

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