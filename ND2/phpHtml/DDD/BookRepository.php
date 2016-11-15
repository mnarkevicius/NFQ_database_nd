<?php

/**
 * Created by PhpStorm.
 * User: mantas
 * Date: 16.11.15
 * Time: 18.26
 */
class BookRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    function getById($id){
        $res = $this->connection->query('SELECT * FROM Books WHERE Books.bookId=' . $id);
        $res->data_seek(0);
        $row = $res->fetch_assoc();
        $book = new Book();
        $book->setId($row['bookId']);
        $book->setTitle($row['title']);
        $book->setGenre($row['genreId']);
        $book->setYear($row['year']);
        return $book;
    }

    function getAll(){
        $res = $this->connection->query('SELECT * FROM Books');
        $res->data_seek(0);
        $list = array();
        foreach($res as $row){
            $row = $row->fetch_assoc();
            $book = new Book();
            $book->setId($row['bookId']);
            $book->setTitle($row['title']);
            $book->setGenre($row['genreId']);
            $book->setYear($row['year']);
            $list->push($book);
        }
        return $list;
    }
}