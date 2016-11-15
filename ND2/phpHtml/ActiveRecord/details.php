<?php include 'Book.php' ?>
<html>
<head></head>
<body>
<?php
$book = new Book();
$book->load($_GET['id']);
echo $book->getTitle();
?>
</body>
</html>