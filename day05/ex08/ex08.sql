SELECT last_name,first_name,date(birthdate) as 'birthdate' FROM user_card
where year(birthdate)=1989
order by last_name ASC
;