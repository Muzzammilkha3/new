<?php
return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=stock_manager;charset=utf8mb4',
        'username' => 'root',
        'password' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],
    'app' => [
        'name' => 'Stock Management System',
        'base_url' => '/',
        'timezone' => 'Asia/Kolkata',
    ],
];
