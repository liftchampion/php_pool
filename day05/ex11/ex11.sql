select UPPER(last_name) as 'NAME', first_name, s.price from user_card, subscription as s
where exists
    (select 1 from member where id_user = id_user_card and exists
        (select 1 from subscription where member.id_sub = subscription.id_sub
                                      AND subscription.price > 42
                                      AND s.price = subscription.price))
order by last_name ASC, first_name ASC
