<?php
return [
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'catalog' => 'catalog/index', // actionIndex in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    '' => 'site/index', // actionIndex in SiteController
];
