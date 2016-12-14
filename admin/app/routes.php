<?php

use Symfony\Component\HttpFoundation\Request;
use Admin\Domain\Article;
use Admin\Form\Type\ArticleType;

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Home page
$app->get('/', function () use ($app) {
    $articles = $app['dao.article']->findAll();

    return $app['twig']->render('index.html.twig', array(
        'articles' => $articles
    ));
})->bind('home');

// Add a new article
$app->match('/article/add', function(Request $request) use ($app) {
    $article = new Article();
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);

    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
    }
    return $app['twig']->render('article.html.twig', array(
        'articleForm' => $articleForm->createView()));
})->bind('admin_article_add');


// Edit an existing article
$app->match('/article/{id}/edit', function ($id, Request $request) use ($app) {
    $article = $app['dao.article']->find($id);
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);

    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.article']->save($article);
        $app['session']->getFlashBag()->add('success', 'Your article was succesfully modified.');
    }

    return $app['twig']->render('article.html.twig', array(
        'article'     => $article,
        'articleForm' => $articleForm->createView()
    ));
})->bind('article_edit');

// Remove an article
$app->get('/article/{id}/delete', function($id, Request $request) use ($app) {
    $app['dao.article']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');

    return $app->redirect($app['url_generator']->generate('home'));
})->bind('article_delete');

// API : get all articles
$app->get('/api/articles', function() use ($app) {
    $articles = $app['dao.article']->findAll();
    // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
    $responseData = array();
    foreach ($articles as $article) {
        $responseData[] = array(
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'description' => $article->getDescription(),
            'image_url' => $article->getImageUrl(),
            'url' => $article->getUrl(),
        );
    }
    // Create and return a JSON response
    return $app->json($responseData);
})->bind('api_articles');
