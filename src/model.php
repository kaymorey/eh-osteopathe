<?php

function getArticles () {
    $filePath = '../web/data/articles.json';
    $json = file_get_contents($filePath);
    $articles = json_decode($json);

    return $articles;
}
