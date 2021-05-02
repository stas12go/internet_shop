<?php
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class SiteController
{
    public function actionIndex(): bool
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts();

        require_once ROOT . '/views/site/index.php';
        return true;
    }

    public function actionContact(): bool
    {
        $filename = ROOT . '/config/email_logs.txt';
        $from = '';
        $message = '';
        $result = false;
        if (isset($_POST['submit'])) {
            $errors = false;
            $from = $_POST['from'];
            $message = $_POST['message'];

            if (!User::checkEmail($from)) $errors[] = "Некорректный емейл";
            $log = date('Y-m-d H:i:s') . " From: " . $from ./*". Subject: ". $subject .*/
                ". Message: " . $message;
            if ($errors === false) $result = file_put_contents($filename, $log . PHP_EOL, FILE_APPEND);
        }


//        $result = mail($mail, $subject, $message);
//        var_dump($result);

        require_once ROOT . '/views/site/contact.php';
        return true;
    }
}