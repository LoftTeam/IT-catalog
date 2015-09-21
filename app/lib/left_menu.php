
<?php

class Left_menu extends  Model
{
    function get_left_menu()
    {
        $sql = "SELECT id, title FROM category_products";

        $result = $this->_pdo->query($sql);

        if(!$result){
            return $result;
        }
        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }

    function get_left_menu_items_by_category_id($id)
    {
        $sql = "SELECT id , title FROM products WHERE id_catalog = {$id}";

        $result = $this->_pdo->query($sql);

        if(!$result){
            return $result;
        }
        $records = $result->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
}

