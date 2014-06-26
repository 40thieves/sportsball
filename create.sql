DROP DATABASE sportsball;
CREATE DATABASE sportsball;
USE sportsball;

CREATE TABLE twitterresponse
(
twitterresponseID integer(8) primary key AUTO_INCREMENT,
content longtext(),
fixtureID integer(8) NOT NULL,
FOREIGN KEY (fixtureID) REFERENCES fixture(fixtureID)
);

CREATE TABLE stadium
(
stadiumID integer(8) primary key AUTO_INCREMENT,
name varchar(30)
);

CREATE TABLE fixture
(
fixtureID integer(8) primary key AUTO_INCREMENT,
stadiumID integer(8) NOT NULL,
isOngoing boolean,
FOREIGN KEY (stadiumID) REFERENCES stadium(stadiumID)
);

CREATE TABLE team
(
teamID integer(8) primary key AUTO_INCREMENT,
name varchar(30) NOT NULL,
UNIQUE (name)
);

CREATE TABLE player
(
playerID integer(8) primary key AUTO_INCREMENT,
squadNo integer(2),
teamID integer(8) NOT NULL,
name varchar(30) NOT NULL,
UNIQUE (name),
FOREIGN KEY (teamID) REFERENCES team(teamID)
);

CREATE TABLE eventType
(
eventID integer(8) primary key AUTO_INCREMENT,
label varchar(30) NOT NULL,
UNIQUE (label)
);

CREATE TABLE fixtureTeam
(
fixtureID integer(8),
teamID integer(8),
homeTeam BOOLEAN,
FOREIGN KEY (fixtureID) REFERENCES fixture(fixtureID),
FOREIGN KEY (teamID) REFERENCES team(teamID)
);

CREATE TABLE fixtureEvent
(
fixtureID integer(8),
eventID integer(8),
playerID integer(8),
teamID integer(8),
minute integer(2),
FOREIGN KEY (fixtureID) REFERENCES fixture(fixtureID),
FOREIGN KEY (eventID) REFERENCES eventType(eventID),
FOREIGN KEY (playerID) REFERENCES player(playerID),
FOREIGN KEY (teamID) REFERENCES team(teamID)
);

INSERT INTO eventType (label)
VALUES 
('Goal'),
('Yellow Card'),
('Red Card');

INSERT INTO team (name)
VALUES
('Arsenal'),
('Aston Villa'),
('Cardiff City'),
('Chelsea'),
('Crystal Palace'),
('Everton'),
('Fulham'),
('Hull City'),
('Liverpool'),
('Manchester City'),
('Manchester United'),
('Newcastle United'),
('Norwich City'),
('Southampton'),
('Stoke City'),
('Sunderland'),
('Swansea City'),
('Tottenham'),
('West Bromwich Albion'),
('West Ham United');

INSERT INTO stadium (name)
VALUES
('The Emirates'),
('Villa Park'),
('Cardiff City Stadium'),
('Stamford Bridge'),
('Selhurst Park'),
('Goodison Park'),
('Craven Cottage'),
('KC Stadium'),
('Anfield'),
('The Etihad'),
('Old Trafford'),
("St James's Park"),
('Carrow Road'),
('St Mary\'s'),
('Brittania Stadium'),
('The Stadium of Light'),
('Liberty Stadium'),
('White Hart Lane'),
('The Hawthorns'),
('Boleyn Ground');

INSERT INTO player (teamID,squadNo,name)
VALUES
(1,1,'Wojciech Szczesny'),
(1,3,'Bacary Sagna'),
(1,4,'Per Mertesacker'),
(1,5,'Thomas Vermaelen'),
(1,6,'Laurent Koscielny'),
(1,7,'Tomas Rosicky'),
(1,8,'Mikel Arteta'),
(1,9,'Lukas Podolski'),
(1,10,'Jack Wilshere'),
(1,11,'Mesut Ozil'),
(1,12,'Olivier Giroud'),
(1,14,'Theo Walcott'),
(1,15,'Alex Oxlade-Chamberlain'),
(1,16,'Aaron Ramsey'),
(1,19,'Santi Cazorla'),
(1,20,'Matthieu Flamini'),
(2,1,'Brad Guzan'),
(2,2,'Nathan Baker'),
(2,3,'Joe Bennett'),
(2,4,'Ron Vlaar'),
(2,5,'Jores Okore'),
(2,6,'Ciaran Clark'),
(2,7,'Leandro Bacuna'),
(2,8,'Karim El Ahmadi'),
(2,9,'Nicklas Helenius'),
(2,10,'Andreas Weimann'),
(2,11,'Gabriel Agbonlahor'),
(2,12,'Marc Albrighton'),
(2,16,'Fabian Delph'),
(2,20,'Christian Benteke'),
(2,27,'Libor Kozak'),
(2,31,'Shay Given'),
(3,1,'David Marshall'),
(3,2,'Matthew Connolly'),
(3,3,'Andrew Taylor'),
(3,4,'Steven Caulker'),
(3,5,'Mark Hudson'),
(3,6,'Ben Turner'),
(3,7,'Peter Whittingham'),
(3,8,'Gary Medel'),
(3,9,'Andreas Cornelius'),
(3,10,'Frazier Campbell'),
(3,11,'Peter Odemwingie'),
(3,14,'Tommy Smith'),
(3,15,'Magnus Eikrem'),
(3,16,'Craig Noone'),
(3,17,'Aron Gunnarsson'),
(3,39,'Craig Bellamy'),
(4,1,'Petr Cech'),
(4,2,'Branislav Ivanovic'),
(4,3,'Ashley Cole'),
(4,4,'David Luiz'),
(4,5,'Michael Essien'),
(4,7,'Ramires'),
(4,8,'Frank Lampard'),
(4,9,'Fernando Torres'),
(4,10,'Juan Mata'),
(4,11,'Oscar'),
(4,12,'John Obi Mikel'),
(4,14,'Andre Schurrle'),
(4,17,'Eden Hazard'),
(4,19,'Demba Ba'),
(4,26,'John Terry'),
(4,29,'Samuel Etoo'),
(5,1,'Julian Speroni'),
(5,2,'Joel Ward'),
(5,3,'Adrian Mariappa'),
(5,4,'Jonathan Parr'),
(5,5,'Patrick McCarthy'),
(5,6,'Jose Campana'),
(5,7,'Yannick Bolasie'),
(5,8,'Kagisho Dikgacoi'),
(5,9,'Kevin Phillips'),
(5,13,'Jason Puncheon'),
(5,15,'Mile Jedinak'),
(5,16,'Dwight Gayle'),
(5,19,'Danny Gabbidon'),
(5,20,'Jonathan Williams'),
(5,21,'Dean Moxey'),
(5,27,'Damien Delaney'),
(5,29,'Marouane Chamakh'),
(6,2,'Tony Hibbert'),
(6,3,'Leighton Baines'),
(6,4,'Darron Gibson'),
(6,5,'John Heitinga'),
(6,6,'Phil Jagielka'),
(6,7,'Nikica Jelavic'),
(6,9,'Arouna Kone'),
(6,11,'Kevin Mirallas'),
(6,15,'Sylvain Distin'),
(6,16,'James McCarthy'),
(6,17,'Romelu Lukaku'),
(6,18,'Gareth Barry'),
(6,20,'Ross Barkley'),
(6,21,'Leon Osman'),
(6,22,'Steven Pienaar'),
(6,23,'Seamus Coleman'),
(6,24,'Tim Howard'),
(7,1,'Maarten Stekelenburg'),
(7,3,'John Arne Riise'),
(7,4,'Phillipe Senderos'),
(7,5,'Brede Hangeland'),
(7,7,'Steve Sidwell'),
(7,8,'Pajtim Kasami'),
(7,9,'Dimitar Berbatov'),
(7,10,'Bryan Ruiz'),
(7,11,'Alex Kacaniklic'),
(7,15,'Kieran Richardson'),
(7,16,'Damien Duff'),
(7,18,'Aaron Hughes'),
(7,19,'Adel Taarabt'),
(7,20,'Hugo Rodallega'),
(7,28,'Scott Parker'),
(7,32,'Clint Dempsey'),
(8,1,'Allan McGregor'),
(8,2,'Liam Rosenior'),
(8,3,'Maynor Figueroa'),
(8,4,'Alex Bruce'),
(8,5,'James Chester'),
(8,6,'Curtis Davies'),
(8,7,'David Meyler'),
(8,8,'Tom Huddlestone'),
(8,9,'Danny Graham'),
(8,10,'Robert Koren'),
(8,11,'Robbie Brady'),
(8,12,'Matthew Fryatt'),
(8,14,'Jake Livermore'),
(8,15,'Paul McShane'),
(8,17,'George Boyd'),
(8,24,'Sone Aluko'),
(9,1,'Brad Jones'),
(9,2,'Glen Johnson'),
(9,3,'Jose Enrique'),
(9,4,'Kolo Toure'),
(9,5,'Daniel Agger'),
(9,6,'Luis Alberto'),
(9,7,'Luis Suarez'),
(9,8,'Steven Gerrard'),
(9,9,'Iago Aspas'),
(9,10,'Phillippe Coutinho'),
(9,12,'Victor Moses'),
(9,14,'Jordan Henderson'),
(9,15,'Daniel Sturridge'),
(9,17,'Mahmadou Sakho'),
(9,21,'Lucas Leiva'),
(9,22,'Simon Mignolet'),
(9,24,'Joe Allen'),
(10,1,'Joe Hart'),
(10,2,'Micah Richards'),
(10,4,'Vincent Kompany'),
(10,5,'Pablo Zabaleta'),
(10,6,'Joleon Lescott'),
(10,7,'James Milner'),
(10,8,'Samir Nasri'),
(10,9,'Alvaro Negredo'),
(10,10,'Edin Dzeko'),
(10,13,'Alexander Kolarov'),
(10,15,'Jesus Navas'),
(10,16,'Sergio Aguero'),
(10,21,'David Silva'),
(10,26,'Martin Demichelis'),
(10,30,'Costel Pantilimon'),
(10,35,'Stevan Jovetic'),
(11,1,'David De Gea'),
(11,2,'Rafael'),
(11,3,'Patrice Evra'),
(11,4,'Phil Jones'),
(11,5,'Rio Ferdinand'),
(11,6,'Jonny Evans'),
(11,8,'Anderson'),
(11,10,'Wayne Rooney'),
(11,11,'Ryan Giggs'),
(11,12,'Chris Smalling'),
(11,15,'Nemanja Vidic'),
(11,16,'Michael Carrick'),
(11,17,'Nani'),
(11,18,'Ashley Young'),
(11,19,'Danny Welbeck'),
(11,20,'Robin Van Persie'),
(12,1,'Tim Krul'),
(12,2,'Fabrizio Coloccini'),
(12,3,'Davide Santon'),
(12,4,'Yohann Cabaye'),
(12,6,'Michael Williamson'),
(12,7,'Moussa Sissoko'),
(12,8,'Vurnon Anita'),
(12,9,'Papiss Demba Cisse'),
(12,10,'Hatem Ben Arfa'),
(12,11,'Yoan Gouffran'),
(12,14,'Loic Remy'),
(12,16,'Ryan Taylor'),
(12,18,'Jonas Gutierrez'),
(12,23,'Shola Ameobi'),
(12,24,'Cheik Tiote'),
(12,27,'Steven Taylor'),
(13,1,'John Ruddy'),
(13,2,'Russell Martin'),
(13,3,'Steven Whittaker'),
(13,4,'Bradley Johnson'),
(13,5,'Sebastien Bassong'),
(13,6,'Michael Turner'),
(13,7,'Robert Snodgrass'),
(13,8,'Jonathan Howson'),
(13,9,'Ricky Van Wolfswinkel'),
(13,10,'Leroy Fer'),
(13,11,'Gary Hooper'),
(13,12,'Anthony Pilkington'),
(13,14,'Wesley Hoolahan'),
(13,16,'Johan Elmander'),
(13,17,'Elliot Bennett'),
(13,19,'Luciano Becchio'),
(14,1,'Kelvin Davis'),
(14,2,'Nathaniel Clyne'),
(14,3,'Maya Yoshida'),
(14,4,'Morgan Schneiderlin'),
(14,5,'Dejan Lovren'),
(14,6,'Jose Fonte'),
(14,7,'Ricky Lambert'),
(14,8,'Steven Davis'),
(14,9,'Jay Rodriguez'),
(14,10,'Gaston Ramirez'),
(14,13,'Danny Fox'),
(14,18,'Jack Cork'),
(14,20,'Adam Lallana'),
(14,21,'Guilherme do Prado'),
(14,23,'Luke Shaw'),
(14,31,'Artur Boruc'),
(15,1,'Asmir Begovic'),
(15,3,'Erik Pieters'),
(15,4,'Robert Huth'),
(15,5,'Marc Muniesa'),
(15,6,'Glenn Whelan'),
(15,7,'Jermaine Pennant'),
(15,8,'Wilson Palacios'),
(15,9,'Kenwyne Jones'),
(15,10,'Marko Arnautovic'),
(15,12,'Marc Wilson'),
(15,16,'Charlie Adam'),
(15,17,'Ryan Shawcross'),
(15,19,'Jonathan Walters'),
(15,25,'Peter Crouch'),
(15,26,'Matthew Etherington'),
(15,32,'Stephen Ireland'),
(16,2,'Phillip Baardsley'),
(16,3,'Andrea Dossena'),
(16,4,'Ki Sung-Yong'),
(16,5,'Wes Brown'),
(16,6,'Cabral'),
(16,7,'Sebastien Larsson'),
(16,8,'Craig Gardner'),
(16,9,'Steven Fletcher'),
(16,10,'Connor Wickham'),
(16,11,'Adam Johnson'),
(16,14,'Jack Colback'),
(16,15,'David Vaughan'),
(16,16,"John O'Shea"),
(16,17,'Jozy Altidore'),
(16,24,'Carlos Cuellar'),
(16,25,'Vito Mannone'),
(17,1,'Michel Vorm'),
(17,2,'Jordi Amat'),
(17,3,'Neil Taylor'),
(17,4,'Chico'),
(17,6,'Ashley Williams'),
(17,7,'Leon Britton'),
(17,8,'Jonjo Shelvey'),
(17,9,'Michu'),
(17,10,'Wilfried Bony'),
(17,11,'Pablo Hernandez'),
(17,12,'Nathan Dyer'),
(17,15,'Wayne Routledge'),
(17,18,'Leroy Lita'),
(17,20,'Jonathan de Guzman'),
(17,22,'Angel Rangel'),
(17,29,'Ashley Richards'),
(18,1,'Heurelho Gomes'),
(18,2,'Kyle Walker'),
(18,3,'Danny Rose'),
(18,4,'Younes Kaboul'),
(18,5,'Jan Vertonghen'),
(18,6,'Vlad Chiriches'),
(18,7,'Aaron Lennon'),
(18,8,'Paulinho'),
(18,9,'Roberto Soldado'),
(18,10,'Emmanuel Adebayor'),
(18,11,'Erik Lamela'),
(18,14,'Lewis Holtby'),
(18,16,'Kyle Naughton'),
(18,17,'Andros Townsend'),
(18,18,'Jermain Defoe'),
(18,19,'Moussa Dembele'),
(18,20,'Michael Dawson'),
(19,1,'Ben Foster'),
(19,2,'Steven Reid'),
(19,3,'Jonas Olsson'),
(19,4,'Goran Popov'),
(19,5,'Claudio Yacob'),
(19,6,'Liam Ridgewell'),
(19,7,'James Morrison'),
(19,8,'Markus Rosenborg'),
(19,9,'Shane Long'),
(19,10,'Scott Sinclair'),
(19,11,'Chris Brunt'),
(19,14,'Diego Lugano'),
(19,16,'Victor Anichebe'),
(19,17,'Graham Dorrans'),
(19,21,'Youssuf Mulumbu'),
(19,22,'Zoltan Gera'),
(20,2,'Winston Reid'),
(20,3,'George McCartney'),
(20,4,'Kevin Nolan'),
(20,5,'James Tomkins'),
(20,7,'Matthew Jarvis'),
(20,8,'Razvan Rat'),
(20,9,'Andy Carroll'),
(20,10,'Jack Collision'),
(20,11,'Modibo Maiga'),
(20,12,'Ricardo Vaz Te'),
(20,14,'Matthew Taylor'),
(20,15,'Ravel Morrison'),
(20,16,'Mark Noble'),
(20,19,'James Collins'),
(20,20,'Guy Demel'),
(20,22,'Jussi Jaaskelainen');

INSERT INTO fixture (stadiumID)
VALUES
(1),
(3),
(4),
(5),
(9),
(10),
(12),
(13),
(19),
(20);

INSERT INTO fixtureTeam (fixtureID,teamID,homeTeam)
VALUES
(1,1,1),
(1,17,0),
(2,4,1),
(2,7,0),
(3,4,1),
(3,18,0),
(4,5,1),
(4,14,0),
(5,9,1),
(5,16,0),
(6,10,1),
(6,2,0),
(7,12,1),
(7,6,0),
(8,13,1),
(8,15,0),
(9,19,1),
(9,11,0),
(10,20,1),
(10,8,0);

SELECT e.label as 'Event', t.name as 'Team', p.name as 'Player', fe.minute
FROM eventType e, fixture f, player p, team t, fixtureEvent fe
WHERE fe.eventID = e.eventID
AND fe.fixtureID = f.fixtureID 
AND fe.playerID = p.playerID
AND p.teamID = t.teamID
ORDER BY fe.minute;