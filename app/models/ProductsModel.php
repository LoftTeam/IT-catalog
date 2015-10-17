<?php

class ProductsModel extends Model
{
    public function get_data()
    {
        $sql = "SELECT products.id, products.title,products.img,products.mark,products.count, products.price, products.description,
                products.id_catalog as id_catalog,
                category_products.title as category_name, category_products.id as category_id
                FROM products
                LEFT JOIN category_products ON products.id_catalog = category_products.id";

        $result = $this->DB->query($sql);
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

        $result = $this->DB->query($sql );
        if(!$result){
            return $result;
        }
        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }

    public function search($words)
    {
        try{
            $sql = "SELECT id,title,img,mark,price,description
                    FROM products
                    WHERE MATCH (title,mark,description) AGAINST (:words  IN BOOLEAN MODE)
                    ";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':words', $words, PDO::PARAM_STR);
            $stmt->execute();

            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

        }catch (Exception $e){
            throw new Exception('Ничего не найдено');
        }

    }

    public function get_product($id)
    {
        try{
            $sql = "SELECT products.id, products.title,products.img,products.mark,products.id_catalog, products.price,
                    products.description, products.count, category_products.title as category_name
                    FROM products
                    LEFT JOIN category_products ON products.id_catalog = category_products.id
                    WHERE products.id = :id";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
            }catch (Exception $e){
                 throw new Exception('Продукт не найден');
            }
    }

    public function get_categories()
    {
        try{
            $sql = 'SELECT id,title FROM  category_products';
            $result = $this->DB->query($sql);
            if(!$result){
                return $result;
            }
            $records = $result->fetchAll(PDO::FETCH_ASSOC);
            return $records;
            }catch (Exception $e){
        throw new Exception('Каталог не найден');
        }
    }

    public function add_category($category_name)
    {
        try{
            $sql = "INSERT INTO category_products(title) VALUES (:category_name)";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
            $stmt->execute();
        }catch (Exception $e){
            throw new Exception('Категория не добавлена');
        }
    }

    public function add_product($product_name, $product_img,
                                $mark,$count, $price,
                                $description, $category_id)
    {
        try{
            $sql = "INSERT INTO products(title,img,mark,count,price,description,id_catalog)
              VALUES (:product_name,:product_img,:mark,:count,:price,:description,:category_id)";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':product_img', $product_img, PDO::PARAM_STR);
            $stmt->bindParam(':mark', $mark, PDO::PARAM_STR);
            $stmt->bindParam(':count', $count, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (Exception $e){
            throw new Exception('Товар не добавлена');
        }
    }

    public function update_product($id,$product_name, $product_img,
                                $mark,$count, $price,
                                $description, $category_id)
    {
        try{
            $sql = "UPDATE products
                    SET title=:product_name,
                        img=:product_img,
                        mark=:mark,
                        count=:count,
                        price=:price,
                        description=:description,
                        id_catalog=:category_id
                    WHERE id=:id;";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':product_img', $product_img, PDO::PARAM_STR);
            $stmt->bindParam(':mark', $mark, PDO::PARAM_STR);
            $stmt->bindParam(':count', $count, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();

        }catch (Exception $e){
            throw new Exception('Товар не изменен');
        }
    }

    public function find_category_by_id($id)
    {
        try{
            $sql = "SELECT id,title FROM category_products
                      WHERE id = :id;";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
        }catch (Exception $e){
            throw new Exception('Категория не найдена');
        }
    }

    public function update_category_by_id($id,$title)
    {
        try{
            $sql = "UPDATE category_products
                    SET title=:title
                    WHERE id=:id;";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();

        }catch (Exception $e){
            throw new Exception('Категория не изменина');
        }
    }

    public function delete_category_by_id($id)
    {
        try{
            $sql = "DELETE FROM category_products
                    WHERE id = :id ";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        }catch (Exception $e){
            throw new Exception('Категория не удалена');
        }
    }

    public function delete_product_by_id($id)
    {
        try{
            $sql = "DELETE FROM products
                    WHERE id = :id ";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        }catch (Exception $e){
            throw new Exception('Товар не удален');
        }
    }

}