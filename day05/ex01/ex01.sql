USE db_ggerardy;
CREATE TABLE `ft_tables` (
    `id` int auto_increment primary key NOT NULL ,
    `login` varchar(8) NOT NULL DEFAULT 'toto' NOT NULL ,
    `group` enum('staff', 'student', 'other') NOT NULL ,
    `creation_date` DATE NOT NULL
);