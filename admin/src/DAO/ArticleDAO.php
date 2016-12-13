<?php

namespace Admin\DAO;

use Admin\Domain\Article;

class ArticleDAO extends DAO
{
    /**
     * Return a list of all articles
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $result = $this->data->articles;

        $articles = array();
        foreach ($result as $row) {
            $articleId = $row->id;
            $articles[$articleId] = $this->buildDomainObject($row);
        }

        return $articles;
    }

    /**
     * Returns an article matching the supplied id.
     *
     * @param string $id
     *
     * @return \Admin\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $result = $this->data->articles;

        $article = null;
        foreach ($result as $row) {
            if ($row->id == $id) {
                $article = $this->buildDomainObject($row);
                break;
            }
        }

        if ($article)
            return $article;
        else
            throw new \Exception("No article matching id " . $id);
    }

    /**
     * Creates an Article object based on a row.
     *
     * @param stdClass $row The JSON row containing Article data.
     * @return \Admin\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row->id);
        $article->setTitle($row->title);
        $article->setDescription($row->description);
        return $article;
    }
}
