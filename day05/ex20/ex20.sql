select
       genre.id_genre AS 'id_genre',
       genre.name AS 'name_genre',
       distrib.id_distrib AS 'id_distrib',
       distrib.name AS 'name_distrib',
       film.title AS 'title_film'
from film left join genre ON genre.id_genre = film.id_genre left join distrib
on film.id_distrib = distrib.id_distrib
where film.id_genre >= 4 and film.id_genre <= 8;