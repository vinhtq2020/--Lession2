<?php
namespace App\models;

use App\core\Application;
use App\core\DbModel;
use App\core\Model;

class CategoryModel extends DbModel
{
    public int $id;
    public string $category_name;
   
    public function tableName():string
    {
        return 'categories';
    }
    public function attributes(): array
    {
        return ["category_name"];
    }
   
    
}
