<?php 
namespace App\Models;

use CodeIgniter\Model;

class BeerModel extends Model{
    protected $table      = 'beer';
    protected $primaryKey = 'id';
    protected $allowedFields=['brand','price','alcohol'];

    /* protected $validationRules=[
        'brand'=> 'required|alpha_space|min_length[3]|max_lenght[75]',
        'price'=> 'required',
        'alcohol'=> 'required'
    ];
    protected $skipValidation=false; */
}