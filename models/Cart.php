<?php


class Cart
{
    public static function addProduct($id)
    {
        $id = intval($id);

       /* Массив с товарами в корзине */
        $productsInCart = [];

        /* Если в корзине уже есть товары (они хранятся в сессии) */
        if (isset($_SESSION['products'])) {
            /* То заполним массив товарами */
            $productsInCart = $_SESSION['products'];
        }

        /* Если товар уже есть в корзине, но был добавлен ещё раз,
        то увеличим количество товара в корзине.
        Иначе добавляем новую запись в массив */
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }
        $_SESSION['products'] = $productsInCart;
        return self::countItems();
    }

    public static function getProducts()
    {
        if (isset($_SESSION['products'])) return $_SESSION['products'];
        return false;
    }

    /**
     * Возвращает количество товаров в корзине
     * @return int|mixed
     */
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();
        $total = 0;
        if ($productsInCart) {
            foreach ($products as $product) {
                $total += $product['price'] * $productsInCart[$product['id']];
            }
        }
        return $total;
    }
}