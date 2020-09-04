<?php

namespace App\Models;

use App\Library\Database;
use Gumlet\ImageResize;

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
        $result = $this->db->select("news",[$column => $where]);
        if ($result == false) {
            $_SESSION['message'] = "Página não encontrada";
            header("Location: ../error");
        }
        return $result;
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
        $values['newsCoverPath'] = str_replace('images/tmpCover/','images/coverNews/',$values['newsCoverPath']);
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
        $values['newsCoverPath'] = str_replace('images/tmpCover/','images/coverNews/',$values['newsCoverPath']);
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

    public function saveTemporaryCoverImage()
    {   
        //path to temporary cover images
        $coverDir = "../../../public/images/tmpCover/";
        
        //generate a new randomic number to the image name
        $randNum = mt_rand(1, 9);
        while (strlen($randNum) < 6) {
            $randNum .= mt_rand(0, 9);
        }

        //create a new name to the image
        $fileName = date("Y-m-d_H-i-s") ."_".$randNum. $_FILES['cover']['name'];
        
        //take the file name and concatenate with the tmp directory
        $pathToImage = $coverDir.basename($fileName);

        //saves the uploaded image to the tmp directory
        $result = move_uploaded_file($_FILES['cover']['tmp_name'], $pathToImage);

        
        
        //resize the image
        $imageResize = new ImageResize($pathToImage);
        $imageResize->resize(500, 300, true);
        $imageResize->save($pathToImage);
        
        //return the path to the temporary image
        return $pathToImage;
    }

    public function saveCoverDefinitely(string $filePath, $atualCover = null)
    {
        
        //move temporary image to the definitely directory
        $new = str_replace('images/tmpCover/','images/coverNews/',$filePath);
        return rename($filePath, $new);
    }
    
}