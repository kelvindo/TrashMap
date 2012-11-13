sftp://kelvindo@myth.stanford.edu/afs/ir.stanford.edu/users/k/e/kelvindo
sftp://kelvindo@myth.stanford.edu/afs/ir.stanford.edu/users/j/z/jzkung/cgi-bin
654063847

CREATE TABLE IF NOT EXISTS `users` (
  U_Id int NOT NULL AUTO_INCREMENT,
  first_name varchar(100) NOT NULL,
  last_name varchar(100) NOT NULL,
  fb_id int(20) NOT NULL,
  points int(11) NOT NULL,
  PRIMARY KEY (U_Id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `users` (`first_name`, `last_name`, `fb_id`, `points`) VALUES
('Sally', 'Mander', 123, 432),
('Mo', 'Lester', 123, 6969),
('Elmer', 'Mah', 123, 765),
('Andrew', 'Moy', 123, 364),
('Quentin', 'Le', 123, 452),
('Hazle', 'Nutt', 123, 0),
('Bill', 'Ding', 123, 123),
('Dick', 'Tator', 123, 999),
('Manny', 'Kinn', 123, 475),
('Kevin', 'Lu', 123, 1337);


CREATE TABLE IF NOT EXISTS `trashcans` (
  T_Id int NOT NULL AUTO_INCREMENT,
  x double precision NOT NULL,
  y double precision NOT NULL,
  type varchar(100) NOT NULL,
  PRIMARY KEY (T_Id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `trashcans` (`x`, `y`) VALUES
(123, 45.2332),
(34, 52),
(3.434, 46),
(23.234, 99.99),
(321.33, 15.22),
(23.234, 242.34),
(123, 12);


CREATE TABLE IF NOT EXISTS trash_activity
(
TA_Id int NOT NULL AUTO_INCREMENT,
U_Id int NOT NULL,
T_Id int NOT NULL,
time_created datetime NOT NULL,
PRIMARY KEY (TA_Id),
FOREIGN KEY (U_Id) REFERENCES users(U_Id),
FOREIGN KEY (T_Id) REFERENCES trashcans(T_Id)
)


INSERT INTO `trash_activity` (`U_Id`, `T_Id`, `time_created`) VALUES
(1, 1, '2012-10-1 03:14:07'),
(1, 3, '2012-10-14 04:44:07'),
(1, 5, '2012-10-15 02:54:07'),
(1, 1, '2012-10-18 06:24:07'),
(1, 3, '2012-10-19 07:34:07'),
(1, 1, '2012-10-21 09:14:07'),
(1, 7, '2012-10-23 01:24:07'),
(1, 9, '2012-10-27 02:54:07'),
(1, 7, '2012-10-28 09:44:07'),
(1, 11, '2012-10-28 02:34:07'),
(1, 13, '2012-10-28 03:14:07'),
(1, 13, '2012-10-28 04:14:07');


CREATE TABLE IF NOT EXISTS `achievements` (
  A_Id int NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  description text(1000) NOT NULL,
  point_worth int(11) NOT NULL,
  PRIMARY KEY (A_Id)
)


INSERT INTO `achievements` (`name`, `description`, `point_worth`) VALUES
('Trash Noob', 'Throwing away your first item using TrashMap', 10),
('Trash Master', 'Throwing away 100 items using TrashMap', 100),
('Trash-topher Trash-lumbus', 'Visiting over 50 trashcans using TrashMap', 50),
('Flying Dumpsters', 'Visiting trash cans at least 50 miels apart', 100),
('Trashcan Finder', 'Finding/confirming 10 unreported trashcans', 100);


CREATE TABLE IF NOT EXISTS achievement_activity
(
AA_Id int NOT NULL AUTO_INCREMENT,
U_Id int NOT NULL,
A_Id int NOT NULL,
time_created datetime NOT NULL,
PRIMARY KEY (AA_Id),
FOREIGN KEY (U_Id) REFERENCES users(U_Id),
FOREIGN KEY (A_Id) REFERENCES achievements(A_Id)
)


//Getting trash-history
SELECT DISTINCT t. * , u. * , ta.time_created
FROM  `trashcans` t
INNER JOIN trash_activity ta ON ta.T_Id = t.T_Id
INNER JOIN users u ON u.U_Id = ta.U_Id
         ON u.U_Id = ta.U_Id

