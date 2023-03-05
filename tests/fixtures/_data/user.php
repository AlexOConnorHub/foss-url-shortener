<?php

return [
    'user1' => [
        'id' => 1,
        'username' => "admin",
        'password' => Yii::$app->security->generatePasswordHash("admin"),
        'auth_key' => "admin-authKey",
        'access_token' => "admin-token",
    ],
    'user2' => [
        'id' => 2,
        'username' => "user",
        'password' => Yii::$app->security->generatePasswordHash("user"),
        'auth_key' => "user-authKey",
        'access_token' => "user-token",
    ]
];