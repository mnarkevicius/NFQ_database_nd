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

    function getById($id)
    {
        $res = $this->connection->query('SELECT `Books`.*, 
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

    function getAll()
    {
        $res = $this->connection->query('SELECT `Books`.*, 
        GROUP_CONCAT(DISTINCT `Authors`.`name` ORDER BY `Authors`.`name` DESC SEPARATOR \', \')  as author
        FROM `Books`
        INNER JOIN `Author-Book` ON `Books`.`bookId` = `Author-Book`.`bookId` 
        INNER JOIN `Authors` ON `Author-Book`.`authorId` = `Authors`.`authorId`
        GROUP BY `Books`.`BookId`;');
        $res->data_seek(0);
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
}