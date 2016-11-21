<?php

/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 16.11.15
 * Time: 17.47
 */
class Book
{
    private $id;
    private $title;
    private $genre;
    private $year;
    private $author;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function load($id){
        $connection = new mysqli("127.0.0.1", "root", "root", "Books", 3306);
        if ($connection->connect_errno) {
            echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
        }
        echo $connection->host_info . "\n";
        $res = $connection->query('SELECT `Books`.*, 
        GROUP_CONCAT(DISTINCT `Authors`.`name` ORDER BY `Authors`.`name` DESC SEPARATOR \', \')  as author
        FROM `Books`
        INNER JOIN `Author-Book` ON `Books`.`bookId` = `Author-Book`.`bookId` 
        INNER JOIN `Authors` ON `Author-Book`.`authorId` = `Authors`.`authorId`
        WHERE `Books`.`bookId`='. $id .'
        GROUP BY `Books`.`BookId`;');
        $row = $res->fetch_assoc();
        $book = new Book();
        $book->setId($row['bookId']);
        $book->setTitle($row['title']);
        $book->setGenre($row['genreId']);
        $book->setYear($row['year']);
        $book->setAuthor($row['author']);
        return $book;
    }

    public function loadAll(){
        $connection = new mysqli("127.0.0.1", "root", "root", "Books", 3306);
        if ($connection->connect_errno) {
            echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
        }
        echo $connection->host_info . "\n";
        $res = $connection->query('SELECT `Books`.*, 
        GROUP_CONCAT(DISTINCT `Authors`.`name` ORDER BY `Authors`.`name` DESC SEPARATOR \', \')  as author
        FROM `Books`
        INNER JOIN `Author-Book` ON `Books`.`bookId` = `Author-Book`.`bookId` 
        INNER JOIN `Authors` ON `Author-Book`.`authorId` = `Authors`.`authorId`
        GROUP BY `Books`.`BookId`;');
        $list = array();
        while ($row = $res->fetch_assoc()) {
            $book = new Book();
            $book->setId($row['bookId']);
            $book->setTitle($row['title']);
            $book->setGenre($row['genreId']);
            $book->setYear($row['year']);
            $book->setAuthor($row['author']);
            $list[] = $book;
        }
        return $list;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Book
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return Book
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Book
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }




}