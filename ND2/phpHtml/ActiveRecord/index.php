<?php
include 'Book.php';
?>

<html>
<head></head>
<body>
<?php
$books = Book::loadAll();
foreach($books as $book){
    echo $book->getTitle() . " " . $book->getAuthor() . "<br>";
}
?>
</body>
</html>
