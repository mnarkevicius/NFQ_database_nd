<?php
include 'Book.php';
?>

<html>
<head></head>
<body>
<?php
$book = Book::load($_GET['id']);
echo $book->getTitle() . " " . $book->getAuthor();
?>
</body>
</html>