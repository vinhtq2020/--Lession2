<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;
use App\models\CategoryModel;
use App\models\ProductModel;

class ProductController extends Controller
{
    public function index(Request $request)
    {   $current_page = 1;
        $rows_limit = 10;
        $qr = "";
        $total_rows = 0;
        if(isset($_GET["page"]))$current_page = (int)$_GET["page"];
        if(isset($_GET["keyword"])){
            $qr="SELECT p.id,p.product_name, c.category_name, p.image_url FROM products p JOIN categories c on p.category_id = c.id
             WHERE product_name LIKE BINARY '%". $_GET["keyword"]."%'";
        }else{
            $qr = "SELECT p.id,product_name,c.category_name, p.image_url FROM products p 
            JOIN categories c on p.category_id = c.id "; 
            $statement = ProductModel::prepare($qr);
            $statement->execute();
            $row_through = ($current_page-1)*$rows_limit;
            $total_rows = $statement->rowCount();
            $qr.="LIMIT $rows_limit OFFSET $row_through";
            
        }
        $statement = ProductModel::prepare($qr);
        $statement->execute();
        $params = array(
            "row"=>$statement->fetchAll(),
            "total"=>$statement->rowCount(),
            "current_page" => $current_page,
            "total_rows" => $total_rows,
            "total_pages" => ceil($total_rows/$rows_limit)
        );
        return $this->render('product', $params);
    }

    public function create()
    {
        $qr = "SELECT * FROM categories";
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        $params = $statement->fetchAll();
        return $this->render('product_create', $params);
    }

    public function store(Request $request)
    {
        $ProductModel = new ProductModel();
        $ProductModel->loadData($request->getBody());
        if ($_FILES['image_url']['size'] != 0 && $_FILES['image_url']['error'] == 0) {
            $target_dir = "images/";
            $file = $_FILES['image_url'];
            $imageFileType = pathinfo($file['name'], PATHINFO_EXTENSION);
            $file['name'] = md5($file['name']) . strtotime("now") . "." . $imageFileType;
            $target_file = $target_dir . $file['name'];
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "upload thành công";
                $ProductModel->image_url = $file['name'];
            }
        }
        $qr = "INSERT INTO products(product_name,category_id, image_url)
        VALUES('$ProductModel->product_name',$ProductModel->category_id,'$ProductModel->image_url')";

        $statement = ProductModel::prepare($qr);
        $statement->execute();

        return $this->redirect('/products', true, 302);
    }

    public function show(Request $request, $params)
    {
        $qr = "SELECT * FROM categories";
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        $category_list = $statement->fetchAll();

        $ProductModel = new ProductModel();
        $id = $params[0];
        $qr = "SELECT * FROM products WHERE id = $id LIMIT 1";

        $statement = ProductModel::prepare($qr);
        $statement->execute();
        $ProductModel->loadData($statement->fetch());
        $isEdit = false;
        $params = [
            $ProductModel,
            $category_list,
            $isEdit
        ];
        return $this->render('product_edit', $params);
    }

    public function edit(Request $request, $params)
    {
        $qr = "SELECT * FROM categories";
        $statement = CategoryModel::prepare($qr);
        $statement->execute();
        $category_list = $statement->fetchAll();

        $ProductModel = new ProductModel();
        $id = $params[0];
        $qr = "SELECT * FROM products WHERE id = $id LIMIT 1";
        $isEdit = true;
        $statement = ProductModel::prepare($qr);
        $statement->execute();
        $ProductModel->loadData($statement->fetch());
        $params = [$ProductModel, $category_list, $isEdit];
        return $this->render('product_edit', $params);
    }

    public function update($request, $params)
    {
        $productModel = new ProductModel();
        $productModel->loadData($request->getBody());
        $qr = "";

        if ($_FILES['image_url']['size'] != 0 && $_FILES['image_url']['error'] == 0) {

            $target_dir = "images/";
            $file = $_FILES['image_url'];
            $imageFileType = pathinfo($file['name'], PATHINFO_EXTENSION);
            $file['name'] = md5($file['name']) . strtotime("now") . "." . $imageFileType;

            $target_file = $target_dir . $file['name'];
            if (move_uploaded_file($file["tmp_name"], $target_file)) {

                $productModel->image_url = $file['name'];
                $qr = ",image_url = '$productModel->image_url' ";
            }
        }

        $id = $params[0];
        $qr = "UPDATE products SET product_name='$productModel->product_name',
         category_id = $productModel->category_id " . $qr;
        $qr .= "WHERE id=$id";
        var_dump($qr);
        $statement = ProductModel::prepare($qr);
        $statement->execute();

        return $this->redirect('/products', true, 302);
    }

    public function delete($request, $params)
    {
        $id = $params[0];
        $qr = "DELETE FROM products WHERE id=$id";
        var_dump($qr);
        $statement = ProductModel::prepare($qr);
        $statement->execute();
        return $this->redirect('/products', true, 302);
    }
}
