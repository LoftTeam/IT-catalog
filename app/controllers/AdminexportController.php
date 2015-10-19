<?php

class AdminexportController extends BackendController
{
    public function __construct(){
        parent::__construct();
        $this->model = new ProductsModel();
    }

     public function actionIndex()
    {
        if(isset($_POST['submit_export'])){
            $products = $this->model->get_all_products();

            try
            {
                $file_path = ROOT."/tmp/price-list.csv";
                if (!is_dir(ROOT.'/tmp/')) {
                    throw new Exception('Каталог tmp/ не найден.');
                }
                $fp = fopen($file_path, 'w+');
                if ( !$fp ) {
                    throw new Exception('Невозможно создать файл');
                }
                foreach ($products as $fields) {
                    fputcsv($fp, $fields);
                }
                fclose($fp);
                $this->file_dwonload($file_path);
                unlink($file_path);

                $this->model->delete_all_products();
                $result = 'Товар успешно экспортирован';

            } catch ( Exception $e ) {
                $errors[] = $e->getMessage();
            }
        }

        if(isset($_POST['submit_import'])){

            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            }
            try{
                $handle = fopen($_FILES['file']['tmp_name'], "r");

                while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                    $this->model->import_data($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
                }
                fclose($handle);

                $result = 'Товар успешно импортирован';
            }catch (Exception $e)
            {
                $errors[] = 'Не удалось импортировать';
            }

        }

        $data = array(
            'title' => 'ВЫгрузка/загрузка товаров',
            'is_logged'=>Session::is_logged(),
            'result'=>(isset($result)) ? $result : null,
            'errors'=>(isset($errors)) ? $errors : null,
            'user_name'=> (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'Админ',
        );
        $this->view->render('admin/export/index.twig',$data);
    }

    public function file_dwonload($file_)
    {
        header("Content-Disposition: attachment; filename=\"" . basename($file_) . "\"");
        header("Content-Type: application/force-download");
        header("Content-Length: " . filesize($file_));
        readfile($file_);
        header("Connection: close");
    }
}