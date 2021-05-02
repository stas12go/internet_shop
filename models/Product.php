<?php


class Product
{
    const SHOW_BY_DEFAULT = 3;

    /**
     * Возвращает массив поступивших последними товаров
     * @param int $count количество товаров
     * @return array
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $productsList = [];

        $result = $db->query('SELECT id, name, price, is_new '
            . 'FROM product WHERE status = "1" ORDER BY id DESC LIMIT ' . $count);
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
//            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Возвращает массив с товарами выбранной категории
     * @param integer $categoryId
     * @return array
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            $db = Db::getConnection();
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            $products = [];
            $result = $db->query('SELECT id, name, price, is_new FROM product '
                . 'WHERE status = 1 and category_id = ' . $categoryId . ' LIMIT ' . self::SHOW_BY_DEFAULT . ' OFFSET ' . $offset);
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;
        }
    }

    public static function getProductById($productId)
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM product WHERE id = ' . $productId);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function getProductsByIds($idsArray)
    {
        $products = [];
        $db = Db::getConnection();
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status = 1 AND category_id = ' . $categoryId);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}