<?php
include 'BookRepository.php';
include 'Book.php';
$mysqli = new mysqli("127.0.0.1", "root", "root", "Books", 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$bookRepository = new BookRepository($mysqli);
?>
<html>
<head></head>
<body>
<?php
$books = $bookRepository->getAll();
foreach($books as $book){
    echo $book->getTitle();
}
?>
</body>
</html>