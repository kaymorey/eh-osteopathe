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
            $app['session']->getFlashBag()->add('success', 'L\'article a été créé avec succès.');
        }
        return $app['twig']->render('article.html.twig', array(
            'article'     => $article,
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
            $app['session']->getFlashBag()->add('success', 'Votre article a bien été modifié.');
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
        $app['session']->getFlashBag()->add('success', 'L\'article a été supprimé avec succès.');

        return $app->redirect($app['url_generator']->generate('default.index'));
    }

    /**
     * Edit articles position ajax action
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editArticlesPositionAjaxAction(Request $request, Application $app) {
        $articles = array();

        if ($request->isXmlHttpRequest()) {
            $id = $request->request->get('id');
            $position = $request->request->get('position');
            $app['dao.article']->updateArticlesPosition($id, $position);
            $articles = $app['dao.article']->findAll();
        }

        return $app['twig']->render('partials/_articles-table-content.html.twig', array(
            'articles'           => $articles,
            'maxVisibleArticles' => 2
        ));
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
