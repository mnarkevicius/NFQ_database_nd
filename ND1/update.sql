--
-- Adding Genres table
--
CREATE TABLE IF NOT EXISTS `Genres` (
     `genreId` int(11) NOT NULL AUTO_INCREMENT,
     `name` varchar(55) DEFAULT NULL,
     PRIMARY KEY(`genreId`)
     )
     ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
--  Dumping `Genres` table data
--
INSERT INTO `Genres` (`name`) VALUES ('Technology');

-- Adding genreId reference column to `Books` table
ALTER TABLE `Books` ADD COLUMN `genreId` INT(11) DEFAULT NULL;

-- Updating `Books` table data with `Genre` information
UPDATE `Books` SET genreId=1 WHERE `genreId` IS NULL;

-- Adding table for many-to-many Authors-Books relation
CREATE TABLE IF NOT EXISTS `Author-Book` (
 `authorId` INT(11) NOT NULL,
 `bookId` INT(11) NOT NULL, 
 PRIMARY KEY(`authorId`, `bookId`)
 );

-- Dumping data
INSERT INTO `Author-Book` (`bookId`, `authorId`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 4),
(4, 6),
(5, 7);

-- Removing unnescesary field
ALTER TABLE `Books` DROP COLUMN `authorId`;

-- Changing charset for `Books` table
ALTER TABLE `Books`
CONVERT TO CHARACTER SET 'utf8';


