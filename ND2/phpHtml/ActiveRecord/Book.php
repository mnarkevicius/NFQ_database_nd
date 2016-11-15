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

    public function load($id){
        $connection = new mysqli("127.0.0.1", "root", "root", "Books", 3306);
        if ($connection->connect_errno) {
            echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
        }
        echo $connection->host_info . "\n";
        $res = $connection->query('SELECT * FROM Books WHERE Books.bookId=' . $id);
        $res->data_seek(0);
        $row = $res->fetch_assoc();
            $this->setId($row['bookId']);
            $this->setTitle($row['title']);
            $this->setGenre($row['genreId']);
            $this->setYear($row['year']);
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