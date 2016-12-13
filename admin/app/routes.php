<?php

// Home page
$app->get('/', function () use ($app) {
    $articles = $app['dao.article']->findAll();

    return $app['twig']->render('index.html.twig', array(
        'articles' => $articles
    ));
})->bind('home');

// Article details
$app->get('/article/{id}', function ($id) use ($app) {
    $article = $app['dao.article']->find($id);
    return $app['twig']->render('article.html.twig', array(
        'article' => $article
    ));
})->bind('article');
