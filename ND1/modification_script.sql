

-- 3. Atlikite šiuos veiksmus:
-- a) Papildykite autorių lentelę įrašais.

INSERT INTO `Authors` (`name`) VALUES 
('Jonas Biliunas'), 
('Antanas Skema');

-- b) Papildykite knygų lentelę, įrašais apie knygas, kurių autorius įrašėte prieš tai.

INSERT INTO `Books` (`authorId`, `title`, `year`) VALUES 
(8, 'Lazda', 1959),
(9, 'Balta drobule', 1968), 
(10, 'The Red One', 1918);

-- c) Išrinkite knygų informaciją prijungdami autorius iš autorių lentelės.

SELECT `Authors`.name, `Books`.title 
FROM `Authors`, `Books` 
WHERE `Authors`.authorId=`Books`.authorId;

-- d) Pakeiskite vienos knygos autorių į kitą.
UPDATE `Books` 
SET authorId=8
WHERE authorId=7;

-- e) Suskaičiuokite kiek knygų kiekvieno autoriaus yra duomenų bazėje (įtraukdami autorius kurie neturi
-- knygų, bei neitraukdami šių autorių).

-- Neitraukiame autoriu be knygu 
SELECT `Authors`.name, COUNT(*) 
FROM `Authors`, `Books` 
WHERE `Authors`.authorId=`Books`.authorId 
GROUP BY `Authors`.name;

-- Itraukiame autorius be knygu 
SELECT `Authors`.name, COUNT(`Books`.authorId) 
FROM `Authors` 
LEFT JOIN `Books` 
ON `Authors`.authorId=`Books`.authorId 
GROUP BY `Authors`.name;

-- f) Pašalinkite jūsų suvestus autorius.
DELETE FROM `Authors` 
WHERE `Authors`.name='Jonas Biliunas' OR `Authors`.name='Antanas Skema' OR `Authors`.name = 'Jack London';

-- g) Pašalinkite knygas, kurios neturi autorių.
DELETE FROM `Books` WHERE `Books`.authorId IS NULL;
		
-- 4. Papildykite duomenų bazę kad būtų galima:
-- a) Suskirstyti knygas į žanrus.

-- Sukuriama zanru lentele--
CREATE TABLE IF NOT EXISTS `Genres` (
`genreId` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(55) DEFAULT NULL,
PRIMARY KEY(`genreId`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


ALTER TABLE `Books`  ADD COLUMN `genreId` INT(11) DEFAULT NULL, ADD FOREIGN KEY `book_genre_fk`(`genreId`) REFERENCES `Genres`(`genreId`);

-- b) Knygos gali turėti vieną ir daugiau autorių.

CREATE TABLE IF NOT EXISTS`Author-Book`(
`authorId` int,
`bookId` int
);

-- c) Sutvarkyti duomenų bazės duomenis, jei reikia papildykite naujais.

INSERT INTO `Author-Book` (`bookId`, `authorId`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 6),
(5, 8),
(9, 8),
(10, 9),
(11, 10),
(3, 2),
(7, 5),
(12, 10);

-- d) Išrinkite visas knygas su jų autoriais. (autorius, jei jų daugiau nei veinas atskirkite kableliais)

SELECT `Books`.*, 
GROUP_CONCAT(DISTINCT `Authors`.`name` ORDER BY `Authors`.`name` DESC SEPARATOR ', ') 
FROM `Books`
INNER JOIN `Author-Book` ON `Books`.`bookId` = `Author-Book`.`bookId` 
INNER JOIN `Authors` ON `Author-Book`.`authorId` = `Authors`.`authorId`
GROUP BY `Books`.`BookId`;

-- e) Papildykite knygų lentelę, kad galetumėte išsaugoti orginalų knygos pavadinimą. (Pavadinime
-- išsaugokite,lietuviškas raides kaip ą,ė,š ir pan.)

ALTER TABLE `Books`
CONVERT TO CHARACTER SET 'utf8';
