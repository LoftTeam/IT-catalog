<?php

class ProductsModel extends Model
{
    public function get_data()
    {
        $sql = "SELECT products.id, products.title,products.img, products.price,
                products.description, category_products.title as category_name
                FROM products
                LEFT JOIN category_products ON products.id_catalog = category_products.id";

        $result = $this->_pdo->query($sql);
        if(!$result){
            return $result;
        }
        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;

    }

    public function filter_data($category_id,$from,$to,$brand)
    {
        $sql = "SELECT products.id, products.title,products.img, products.price,
                products.description, category_products.title as category_name
                FROM products
                LEFT JOIN category_products ON products.id_catalog = category_products.id
                WHERE
                products.mark LIKE '%$brand%'
                AND category_products.id = $category_id
                AND products.price >= $from
                AND products.price <= $to
                ";
    /*    var_dump($sql);
        exit;*/
        $result = $this->_pdo->query($sql);
        if(!$result){
            return $result;
        }
        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }

    public function get_product($id)
    {
        $sql = "SELECT products.id, products.title,products.img, products.price,
                products.description, products.count, category_products.title as category_name
                FROM products
                LEFT JOIN category_products ON products.id_catalog = category_products.id WHERE products.id = :id";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        return $records;
    }

    public function get_categories()
    {
        $sql = "SELECT id,title FROM  category_products";
        $result = $this->_pdo->query($sql);
        if(!$result){
            return $result;
        }
        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
}