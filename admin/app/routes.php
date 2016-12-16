<?php

// ---- DefaultController ----
// Index page
$app->get('/', 'Admin\Controller\DefaultController::indexAction')->bind('default.index');

// Login page
$app->get('/login', 'Admin\Controller\DefaultController::loginAction')->bind('default.login');

// ---- ArticleController ----
// Add an article
$app->match('article/add', 'Admin\Controller\ArticleController::addAction')->bind('article.add');

// Edit an article
$app->match('article/edit/{id}', 'Admin\Controller\ArticleController::editAction')->bind('article.edit');

// Delete an article
$app->match('article/delete/{id}', 'Admin\Controller\ArticleController::deleteAction')->bind('article.delete');

// Update articles list after position change
$app->match('article/update/ajax', 'Admin\Controller\ArticleController::editArticlesPositionAjaxAction')->bind('article.update.ajax');

// ---- ApiController ----
// Get all articles
$app->get('/api/articles', 'Admin\Controller\ApiController::getArticlesAction')->bind('api.articles');
