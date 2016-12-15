<?php

namespace Admin\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Admin\Domain\Article;
use Admin\Form\Type\ArticleType;

Class ArticleController {

    /**
     * Add article action
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addAction(Request $request, Application $app) {
        $article = new Article();
        $urlForOpengraph = $request->request->get('url_for_opengraph');

        if ($urlForOpengraph) {
            $article = $this->getArticleFromOpengraphData($urlForOpengraph);
        }

        $articleForm = $app['form.factory']->create(new ArticleType(), $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid() && !$urlForOpengraph) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('article.html.twig', array(
            'articleForm' => $articleForm->createView(),
            'title'       => 'Ajout d\'un article',
            'submit'      => 'Ajouter'
        ));
    }

    /**
     * Edit article action
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $articleForm = $app['form.factory']->create(new ArticleType(), $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'Your article was succesfully modified.');
        }

        return $app['twig']->render('article.html.twig', array(
            'article'     => $article,
            'articleForm' => $articleForm->createView(),
            'title'       => 'Modification d\'un article',
            'submit'      => 'Modifier'
        ));
    }

    /**
     * Delete article action
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function deleteAction($id, Request $request, Application $app) {
        $app['dao.article']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');

        return $app->redirect($app['url_generator']->generate('home'));
    }

    /**
     * Create Article from OpenGraph data
     *
     * @param string $url Url to inspect
     *
     * @return Article $article Created article with data
     */
    private function getArticleFromOpengraphData($url) {
        $opengraphUrl = 'https://opengraph.io/api/1.0/site/' . urlencode($url);

        $json = file_get_contents($opengraphUrl);
        $data = json_decode($json, true);

        $title = $this->replaceAccents($data['hybridGraph']['title']);
        $description = $this->replaceAccents($data['hybridGraph']['description']);
        $imageUrl = $data['hybridGraph']['image'];

        $article = new Article();

        $article->setTitle($title);
        $article->setDescription($description);
        $article->setImageUrl($imageUrl);
        $article->setUrl($url);

        return $article;
    }

    /**
     * Replace accents encoded in UTF8
     *
     * @param string $string to modify
     *
     * @return string $data with correct accents
     */
    private function replaceAccents($string) {
        $find = Array('Ã', 'Ã¢', 'Ã©', 'Ã¨', 'Ãª', 'Ã«', 'Ã®', 'Ã¯', 'Ã´', 'Ã¶', 'Ã¹', 'Ã»', 'Ã¼', 'Ã§', 'Å', 'â¬');
        $replace = Array('à', 'â', 'é', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', 'ç', 'œ', '€');

        $data = strtr($string, array_combine($find, $replace));

        return $data;
    }

}
