<?php

class AdminordersController extends  BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new CartModel();
    }

    function actionIndex()
    {
        try{
            $orders = $this->model->get_all_orders();
        }catch (Exception $e){
            $errors[] = $e->getMessage();
        }

        $data = array(
            'title' => 'Заказы',
            'is_logged'=>Session::is_logged(),
            'errors'=>(isset($errors)) ? $errors : null,
            'orders'=>(isset($orders)) ? $orders : null,
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/orders/index.twig',$data);
    }

    function actionView($id = 1)
    {

        $id = (int)$id[0];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $new_status = ClearInput::clearInput($_POST['status']);
            $usr_id =  ClearInput::clearInput($_POST['usr_id'],'i+');

            try{
                $this->model->update_order_status_by_id($id,$new_status);
                $user = new UserModel();
                $user = $user->getUserByID($usr_id);

            }catch (Exception $e) {
                $errors[] = $e->getMessage();
            }

            if(!isset($errors)){
                $body = "Статус заказа изменен на - $new_status";
                $subject = 'Статус заказа';
                $emails = $user['email'];

                try {
                    $mail = new SendEmail($body,$emails,$subject);

                }catch (Exception $e){
                    $errors[] = $e->getMessage();
                }
            }
        }

        try{
            $order = $this->model->get_order_by_id($id);
            $products = $this->model->get_products_from_order_by_id($id);
        }catch (Exception $e){
            $errors[] = $e->getMessage();
        }

        if(isset($products)){
            //count total price cart
            $cpc = sizeof($products);
            for($i=0;$i < $cpc;++$i){
                $total_count[]= $products[$i]['price'];
            }
            $total_price = array_sum($total_count);
        }

        $data = array(
            'title' => 'Просмотр заказа',
            'is_logged'=>Session::is_logged(),
            'order'=>(isset($order)) ? $order : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'total_price'=>(isset($total_price)) ? $total_price : null,
            'products'=>(isset($products)) ? $products : null,
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/orders/view.twig',$data);
    }

    public function actionDelete($id = 1)
    {
        $id = (int)$id[0];

        try{
            $this->model->delete_order_by_id($id);
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/adminorders/index/';
            header('Location:' . $host);
        }catch (Exception $e){
             echo $e->getMessage();
        }
    }
}