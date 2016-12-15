<?php

namespace Admin\Controller;

use Silex\Application;

class ApiController {

    /** API articles get action
     *
     * @param Application $app Silex application
     *
     * @return All articles in JSON format
     */
    public function getArticlesAction(Application $app) {
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

        return $app->json($responseData);
    }

}
