SELECT `title`  AS `Title`, 
`duration` AS `Summary`,
`prod_year` AS  `prod_year`
FROM `film`
INNER JOIN  `genre` ON genre.id_genre = film.id_genre
WHERE  genre.name LIKE 'erotic'
ORDER BY prod_year DESC;
