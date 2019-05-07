INSERT INTO ft_tables (login, creation_date, `group`)
SELECT last_name,birthdate,'other' FROM user_card
        where last_name like '%a%' AND LENGTH(last_name) < 9
order by last_name ASC
LIMIT 10
;