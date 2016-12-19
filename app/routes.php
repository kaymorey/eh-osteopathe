<?php

// ---- FrontController ----
// Index page
$app->get('/', 'EmineHakan\Controller\FrontController::indexAction')->bind('front.index');

// About page
$app->get('/votre-praticien', 'EmineHakan\Controller\FrontController::aboutAction')->bind('front.about');

// Consultation page
$app->get('/consultation', 'EmineHakan\Controller\FrontController::consultationAction')->bind('front.consultation');

// Turkish page
$app->get('/ana-sayfa', 'EmineHakan\Controller\FrontController::turkishAction')->bind('front.turkish');

// ---- AdminController ----
// Index page
$app->get('admin/', 'EmineHakan\Controller\AdminController::indexAction')->bind('admin.index');

// Login page
$app->get('/admin/login', 'EmineHakan\Controller\AdminController::loginAction')->bind('admin.login');

// ---- ArticleController ----
// Add an article
$app->match('admin/article/add', 'EmineHakan\Controller\ArticleController::addAction')->bind('admin.article.add');

// Edit an article
$app->match('admin/article/edit/{id}', 'EmineHakan\Controller\ArticleController::editAction')->bind('admin.article.edit');

// Delete an article
$app->match('admin/article/delete/{id}', 'EmineHakan\Controller\ArticleController::deleteAction')->bind('admin.article.delete');

// Update articles list after position change
$app->match('admin/article/update/ajax', 'EmineHakan\Controller\ArticleController::editArticlesPositionAjaxAction')->bind('admin.article.update.ajax');

// ---- ApiController ----
// Get all articles
$app->get('/api/articles', 'EmineHakan\Controller\ApiController::getArticlesAction')->bind('api.articles');
