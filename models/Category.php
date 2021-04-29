<?php

class Category
{
    /**
     * Возвращает массив со списком категорий
     */
    public static function getCategoriesList(): array
    {
        /* Запрос к БД */
        $db = Db::getConnection();

        $categoryList = [];

        $result = $db->query('SELECT id, name '
            . 'FROM category '
            . 'ORDER BY sort_order ASC ');
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
}
