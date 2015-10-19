<?php

class CartController extends FrontendController
{
    public $cart;

    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
        $this->cart = new CartModel();
    }

    public function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(Session::is_logged() === true){
                $product_id =  ClearInput::clearInput($_POST['product_id'],'i+');
                $count = ClearInput::clearInput($_POST['count'],'i+');
                //get product by id
                $product = $this->model->get_product($product_id);

                if($count > $product['count']){
                    $errors[] = 'Такого кол-ва нет на складе';
                }

                if(isset($product_id) && isset($count) && !isset($errors)){
                    try{
                        $this->cart->add_to_cart($_SESSION['user_id'],$product_id,$count);

                        $result = 'Успешно добавлено в корзину';
                    }catch (Exception $e){
                        $errors[] = $e->getMessage();
                    }
                }else{
                    $errors[] = 'Не удалось добавить в корзину';
                }
            }
        }

        if(Session::is_logged() === true){
            try{
                //fetch all from cart
                $cart_products = $this->cart->get_cart($_SESSION['user_id']);
            }catch (Exception $e){
                $errors[] = $e->getMessage();
            }

            if(!sizeof($cart_products)){
                $errors[] = 'Корзина пуста';
            }

            if(!isset($errors) && sizeof($cart_products)){
                //count total price cart
                $cpc = sizeof($cart_products);
                for($i=0;$i < $cpc;++$i){
                    $total_count[]= $cart_products[$i]['total_price'];
                }
                $total_price = array_sum($total_count);
            }

        }


        $data = array(
            'title' => 'Корзина',
            'cart_products'=>(isset($cart_products)) ? $cart_products : null,
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'total_price'=>(isset($total_price)) ? $total_price : null,
            'categories'=>$this->model->get_categories(),
            'products'=>$this->model->get_data(),
            'is_logged'=>Session::is_logged(),
        );

        $this->view->render('/cart/cart.twig',$data);
    }

    public function actionDelete($id)
    {
        $id = $id[0];

        if(Session::is_logged() === true){
            try{
                $this->cart->cart_delete_pruct_by_id($id);
                header("Location: /cart/");
            }catch (Exception $e){
                $errors[] = $e->getMessage();
            }
        }
    }

    public function actionOrder()
    {
        if(Session::is_logged() === false){
            $errors[] = 'Вы не авторизованы';
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $payment_methot = ClearInput::clearInput($_POST['payment_methot'],'s');
            $delivery_service = ClearInput::clearInput($_POST['delivery_service'],'s');
            $message = ClearInput::clearInput($_POST['message'],'s');

            try{
                //fetch all from cart
                $cart_products = $this->cart->get_cart($_SESSION['user_id']);
            }catch (Exception $e){
                $errors[] = $e->getMessage();
            }

            if(!isset($errors) && sizeof($cart_products) > 0 ){
                try{
                    //Добавить заказ
                    $this->cart->add_to_order($_SESSION['user_id'],$payment_methot,$delivery_service,$message);
                    //Удалить заказаный товар из корзины
                    $this->cart->remove_all($_SESSION['user_id']);

                    //Получить настройки config.ini
                    $config = parse_ini_file(ROOT."/app/config/config.ini");

                    //сообщение администратору
                    $body = "Поступил новый заказ";
                    $subject = 'Новый заказ';
                    $emails = $config['admin_email'];

                    try {
                        $mail = new SendEmail($body,$emails,$subject);
                        $result = 'Письмо успешно отправлено';

                    }catch (Exception $e){
                        $errors[] = $e->getMessage();
                    }

                    //Получить email пользователя
                    $user = new UserModel();
                    $user = $user->getUserByID($_SESSION['user_id']);

                    //Сообщение покупателю
                    $body = "Заказ принят. Ожидайте скоро с вами свяжустся";
                    $subject = 'Заказ';
                    $emails = $user['email'];

                    try {
                        $mail = new SendEmail($body,$emails,$subject);
                        $result = 'Письмо успешно отправлено';

                    }catch (Exception $e){
                        $errors[] = $e->getMessage();
                    }

                    $result = 'Заказ принят';
                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }

            $data = array(
                'title' => 'Заказ',
                'result'=>(isset($result)) ? $result : null,
                'errors'=>(isset($errors)) ? $errors : null,
                'categories'=>$this->model->get_categories(),
                'products'=>$this->model->get_data(),
                'is_logged'=>Session::is_logged(),
            );

            $this->view->render('/cart/result.twig',$data);

        }
    }
}