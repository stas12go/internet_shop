<?php
return [
    'cabinet/edit' => 'cabinet/edit', // actionEdit in CabinetController
    'cabinet/history' => 'cabinet/history', // actionHistory in CabinetController
    'cabinet' => 'cabinet/index', // actionIndex in CabinetController

//    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd in CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax in CartController
    'cart' => 'cart/index', // actionIndex in CartController

    'catalog' => 'catalog/index', // actionIndex in CatalogController

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController

    'contacts' => 'site/contact', // actionContact in SiteController

    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController

    'user/register' => 'user/register', // actionRegister in UserController
    'user/login' => 'user/login', //actionLogin in UserController
    'user/logout' => 'user/logout', //actionLogout in UserController

    '' => 'site/index', // actionIndex in SiteController
];
