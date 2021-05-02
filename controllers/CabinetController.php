<?php


class CabinetController
{
    public function actionIndex(): bool
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        require_once ROOT . '/views/cabinet/index.php';
        return true;
    }

    public function actionEdit()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) $errors[] = 'Имя не может быть короче 2ух символов';
            if (!User::checkPassword($password)) $errors[] = 'Пароль не может содержать менее 6 символов';
            if ($errors == false) $result = User::edit($userId, $name, $password);
        }
        require_once ROOT . '/views/cabinet/edit.php';
        return true;
    }
}