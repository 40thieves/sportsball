CREATE DATABASE sportsball;
USE sportsball;

CREATE TABLE stadium
(
stadiumID integer(8) primary key AUTO_INCREMENT,
name varchar(30)
);

CREATE TABLE fixture
(
fixtureID integer(8) primary key AUTO_INCREMENT,
stadiumID integer(8) NOT NULL,
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

CREATE TABLE event
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
minute integer(2),
FOREIGN KEY (fixtureID) REFERENCES fixture(fixtureID),
FOREIGN KEY (eventID) REFERENCES event(eventID),
FOREIGN KEY (playerID) REFERENCES player(playerID)
);

INSERT INTO event (label)
VALUES 
('Goal'),
('Yellow Card'),
('Red Card');

INSERT INTO team (name)
VALUES 
('Arsenal'),
('Chelsea'),
('Crystal Palace'),
('Tottenham');

INSERT INTO stadium (name)
VALUES
('The Emirates'),
('Stamford Bridge'),
('Selhurst Park'),
('White Hart Lane');

INSERT INTO player (name,squadNo,teamID)
VALUES
('Giroud',10,1),
('Podolski',9,1),
('Hazard',8,2),
('Terry',6,2),
('Jedinak',15,3),
('Chamakh',29,3),
('Lennon',7,4);

INSERT INTO fixture (stadiumID)
VALUES
(1),
(3);

INSERT INTO fixtureTeam (fixtureID,teamID,homeTeam)
VALUES
(1,1,1),
(1,2,0),
(2,3,1),
(2,4,0);

INSERT INTO fixtureEvent (fixtureID,eventID,playerID,minute)
VALUES
(1,1,2,23),
(2,1,6,27),
(2,1,6,53);

SELECT e.label as 'Event', t.name as 'Team', p.name as 'Player', fe.minute
FROM event e, fixture f, player p, team t, fixtureEvent fe
WHERE fe.eventID = e.eventID
AND fe.fixtureID = f.fixtureID 
AND fe.playerID = p.playerID
AND p.teamID = t.teamID
ORDER BY fe.minute;