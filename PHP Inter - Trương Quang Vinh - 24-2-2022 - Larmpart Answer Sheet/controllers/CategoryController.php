<?php
namespace App\controllers;

use App\core\Controller;
use App\core\Request;
use App\models\CategoryModel;

class CategoryController extends Controller
{
    public function index(){
        $current_page = 1;
        $rows_limit = 10;
        $qr = "";
        $total_rows = 0;
        if(isset($_GET["page"]))$current_page = (int)$_GET["page"];
        if(isset($_GET["keyword"])){
        $qr = "SELECT * FROM categories WHERE category_name LIKE BINARY '%". $_GET["keyword"]."%'";
        }else{
            $qr = "SELECT * FROM categories";
            $statement = CategoryModel::prepare($qr);
            $statement->execute();
            $row_through = ($current_page-1)*$rows_limit;
            $total_rows = $statement->rowCount();
            $qr.=" LIMIT $rows_limit OFFSET $row_through";
        }
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        $params = array(
            "row" => $statement->fetchAll(),
            "total"=>$statement->rowCount(),
            "current_page" => $current_page,
            "total_rows" => $total_rows,
            "total_pages" => ceil($total_rows/$rows_limit)
        );
        return $this->render('category',$params);
    }
    
    public function create(){
        return $this->render('category_create');
    }

    public function store(Request $request){
        
        $categoryModal = new CategoryModel();
        $categoryModal->loadData( $request->getBody());
        $qr = "INSERT INTO categories(category_name)VALUES('$categoryModal->category_name')";
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        
        return $this->redirect('/categories',true,302);
    }

    public function show(Request $request,$params){
        $categoryModel = new CategoryModel();
        $id = $params[0];
        $qr = "SELECT * FROM categories WHERE id = $id LIMIT 1";
      
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        $categoryModel->loadData($statement->fetch());
        $isEdit = false;
        $params = [
            $categoryModel,
            $isEdit
        ];
        return $this->render('category_edit', $params);
    }

    public function edit(Request $request, $params){
        $categoryModel = new CategoryModel();
        $id = $params[0];
        $qr = "SELECT * FROM categories WHERE id = $id LIMIT 1";
        $isEdit=true;
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        $categoryModel->loadData($statement->fetch());
        $params = [$categoryModel, $isEdit];
        return $this->render('category_edit', $params);
    }

    public function update($request, $params){
        $categoryModal = new CategoryModel();
        $categoryModal->loadData( $request->getBody());
        $id = $params[0];
        $qr = "UPDATE categories SET category_name='$categoryModal->category_name' WHERE id=$id";
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        
        return $this->redirect('/categories',true,302);
    }

    public function delete($request, $params){
        $id = $params[0];
        $qr = "DELETE From categories WHERE id=$id";
        $statement = CategoryModel::prepare($qr);
        $statement ->execute();
        return $this->redirect('/categories',true,302);
    }
    
}