<?php


class CartController
{
    public function actionAdd($id)
    {
//        Добавляем товар в корзину
        Cart::addProduct($id);

//        Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionAddAjax($id)
    {
        /* Добавляем товар в корзину */
        echo "(" . Cart::addProduct($id) . ")";
        return true;
    }

    public function actionIndex()
    {
        $categories =[];
        $categories = Category::getCategoriesList();

        $productsInCart = false;
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            /* Получаем полную информацию о товарах */
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            /* Получаем сумму товаров */
            $totalPrice = Cart::getTotalPrice($products);
        }
        require_once ROOT . "/views/cart/index.php";
        return true;
    }
}