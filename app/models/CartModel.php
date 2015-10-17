<?php

class CartModel extends Model
{
    public function get_cart($id)
    {
        try{
            $sql = "SELECT cart.id as cart_id, products.id, products.title, products.img,(products.price*cart.count) as total_price,
                            cart.count,category_products.title as category_name
                        FROM products
                        INNER JOIN cart ON products.id = cart.product_id
                         INNER JOIN category_products ON products.id_catalog = category_products.id
                        WHERE cart.user_id = :id
                  ";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }catch (Exception $e){
            throw new Exception('Невозможно получить список');
        }
    }

    public function add_to_cart($user_id,$product_id,$count)
    {
        try{
            $sql = "INSERT INTO cart(user_id,product_id,count)
                      VALUES(:user_id,:product_id,:count)
                    ";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':count', $count, PDO::PARAM_INT);
            $stmt->execute();
        }catch (Exception $e){
            throw new Exception('Не получилось добавить в корзину');
        }
    }

    public function cart_delete_pruct_by_id($id)
    {
        try {
            $sql = "DELETE FROM cart WHERE id = :id;";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

        }catch (Exception $e){
            throw new Exception('Не удалось удалить из корзины');
        }
    }

    public function add_to_order($id_user,$payment_methot,$delivery_service,$message)
    {
        try {
            $sql = "INSERT INTO orders (id_user,date_order,payment_methot,delivery_service,message)
                      VALUES (:id_user,Now(),:payment_methot,:delivery_service,:message);

                      INSERT INTO order_products (`id_order`,`product_id`,`count`)
                        SELECT orders.id, cart.product_id,cart.count FROM cart INNER JOIN orders
                        ON orders.id_user = cart.user_id;
                      )";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':payment_methot', $payment_methot, PDO::PARAM_STR);
            $stmt->bindParam(':delivery_service', $delivery_service, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->execute();

        }catch (Exception $e){
            throw new Exception('Не удалось оформить заказ');
        }
    }

    public function remove_all($id)
    {
        try{
            $sql = "DELETE FROM cart WHERE user_id = :id";

            $stmt = $this->DB->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (Exception $e){
            throw new Exception('Не удалось из корзины');
        }
    }
}