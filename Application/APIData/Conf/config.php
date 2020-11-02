<?php
return array(
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'localhost',
    'DB_NAME'=>'mogugai',
    'DB_USER'=>'root',
    'DB_PWD'=>'123456',
    'DB_PORT'=>'3306',
    'DB_PREFIX'=>'',//开启数据库表名前缀
    'DB_CHARSET'=>'utf8',
    'SHOW_PAGE_TRACE'=>true,
    'TMPL_PARSE_STRING'=>array(
        '__ST__' => __ROOT__.'/Public/static',
        '__CSS__' => __ROOT__.'/Public/static/css',
        '__JS__' => __ROOT__.'/Public/static/js',
        '__IMG__' => __ROOT__.'/Public/static/img',
        '__FRONTS__' => __ROOT__.'/Public/static/front')


	//'配置项'=>'配置值'
);