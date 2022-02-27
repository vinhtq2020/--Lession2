<?php
namespace App\models;

use App\core\Application;
use App\core\DbModel;
use App\core\Model;

class ProductModel extends DbModel
{
    public int $id;
    public string $product_name;
    public int $category_id;
    public string $image_url;
    public function tableName():string
    {
        return 'productModel';
    }
    public function attributes(): array
    {
        return ["product_name", "category_id","image_url"];
    }
   
    
}
