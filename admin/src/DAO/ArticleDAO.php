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
        $sql = 'SELECT * FROM eh_article ORDER BY eh_article.position';

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
        $sql = 'SELECT * FROM eh_article WHERE eh_article.id=:id';

        $statement = $this->getDb()->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();

        $row = $statement->fetch();

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception('No article matching id ' . $id);
    }

    public function getNbArticles() {
        $sql = 'SELECT COUNT(*) as count FROM eh_article';

        $statement = $this->getDb()->executeQuery($sql);
        $result = $statement->fetch();

        return $result;
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
            $nbArticles = $this->getNbArticles();
            $position = $nbArticles['count'];
            $articleData['position'] = $position;

            $this->getDb()->insert('eh_article', $articleData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $article->setId($id);
            $article->setPosition($position);
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
