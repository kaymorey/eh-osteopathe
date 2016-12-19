<?php

namespace EmineHakan\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AdminController {

    /**
     * Index action
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $articles = $app['dao.article']->findAll();

        return $app['twig']->render('admin/index.html.twig', array(
            'articles'           => $articles,
            'maxVisibleArticles' => 9
        ));
    }

    /**
     * Login action
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('admin/login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }
}
