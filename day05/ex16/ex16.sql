select count(*) as 'movies' from member_history
where (date >= '2006-10-30' and date <= '2007-07-27') or (month(date) = 12 and day(date) = 24)
;