select title as 'Title', summary as 'Summary', prod_year from film
where exists
    (select 1 from genre where genre.id_genre = film.id_genre AND genre.name='erotic')
ORDER BY prod_year DESC
;