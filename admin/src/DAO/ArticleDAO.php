<?php

namespace Admin\DAO;

use Admin\Domain\Article;

class ArticleDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = 'SELECT * from eh_article order by position';
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

     /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = 'SELECT * from eh_article WHERE id=?';
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception('No article matching id ' . $id);
    }

    /**
     * Saves an article into the database.
     *
     * @param \Admin\Domain\Article $article The article to save
     */
    public function save(Article $article) {
        $articleData = array(
            'title' => $article->getTitle(),
            'image_url' => $article->getImageUrl(),
            'description' => $article->getDescription(),
            'url' => $article->getUrl()
        );

        if ($article->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('eh_article', $articleData, array('id' => $article->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('eh_article', $articleData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $article->setId($id);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('eh_article', array('id' => $id));
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row['id']);
        $article->setPosition($row['position']);
        $article->setTitle($row['title']);
        $article->setDescription($row['description']);
        $article->setImageUrl($row['image_url']);
        $article->setUrl($row['url']);
        return $article;
    }
}
