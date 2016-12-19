<?php

namespace EmineHakan\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class FrontController {

    /**
     * Index action
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $articles = $app['dao.article']->findAll();

        return $app['twig']->render('index.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * About action
     *
     * @param Application $app Silex application
     */
    public function aboutAction(Application $app) {

        return $app['twig']->render('about.html.twig');
    }

    /**
     * Consultation action
     *
     * @param Application $app Silex application
     */
    public function consultationAction(Application $app) {

        return $app['twig']->render('consultation.html.twig');
    }

    /**
     * Turkish action
     *
     * @param Application $app Silex application
     */
    public function turkishAction(Application $app) {

        return $app['twig']->render('turkish.html.twig');
    }

}
