<?php

$params = [
    'adminEmail' => 'admin@shortener.tld',
    'senderEmail' => 'noreply@shortener.tld',
    'senderName' => 'Shortener.tld automated e-mail system',
    'uuidLength' => 4,
    'company' => 'Link Shortener',
    'siteName' => 'Link Shortener',
    'siteTitle' => 'FOSS Link Shortener',
    'siteDescription' => 'FOSS Link Shortener is a free and open source link shortener written in PHP using the Yii2 framework.',
    'meta_description' => 'Free and open source link shortener',
    'meta_keywords' => 'link shortener, free, open source, php, yii2, mysql, bootstrap5, jquery',
];

if (file_exists(__DIR__ . '/params-production.php')) {
    $params = array_merge($params, require __DIR__ . '/params-production.php');
}

return $params;
