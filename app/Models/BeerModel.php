<?php 
namespace App\Models;

use CodeIgniter\Model;

class BeerModel extends Model{
    protected $table      = 'beer';
    protected $primaryKey = 'id';
    protected $allowedFields=['brand','price','alcohol'];
}