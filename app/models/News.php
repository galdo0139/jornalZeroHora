<?php

namespace App;

use App\Config\Database;

class News{
    protected $newsIdPrimária;
    protected $newsTitle;
    protected $newsDescription;
    protected $newsContent;
    protected $newsAuthor;
    protected $created_at;

    protected $db;


    public function __construct(object $db)
    {
        $this->db = $db;
    }
 
    /**
     * getNews
     *
     * Return a list with all news registred
     * 
     * @param  Database $database
     * @return array
     */  
    public function getNewsList()
    {
        return $this->db->select("news");
    }
    
    /**
     * getNews
     * 
     * Return a single news by a given link
     *
     * @param  mixed $column
     * @param  mixed $where
     * @return array
     */
    public function getNews(string $column, string $where)
    {
        return $this->db->select("news",[$column => $where]);
    }
    
    /**
     * createNews
     *
     * Register a News on the database
     * 
     * @param  mixed $fields
     * @param  mixed $values
     * @return boll
     */
    public function createNews(array $values)
    {
        return $this->db->insert("news", $values);
    }
    
    /**
     * editNews
     *
     * Edit an existing news on the database
     * 
     * @param  mixed $fields
     * @param  mixed $values
     * @return bool
     */
    public function editNews(array $values, int $id)
    {
        return $this->db->update("news", $values, "newsId", $id);
    }
    
    /**
     * deleteNews
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteNews(string $id)
    {
        return $this->db->delete("news", "newsId", $id);
    }
    




    public function getPublishedDate(string $createdAt)
    {
        $substringPosition = strpos($createdAt, " ");
        $createdDate = explode("-",substr($createdAt,0,$substringPosition));
        $createdTime = explode(":",substr($createdAt,$substringPosition + 1));
        $time = mktime($createdTime[0],$createdTime[1],$createdTime[2],$createdDate[1],$createdDate[2],$createdDate[0]);
        return date("d/m/Y - H:i", $time);
    }

    public function getAuthorName(string $where)
    {
        $author = $this->db->select("users", ["userId" => $where]);
        return $author['authorName'];
    }
    
}