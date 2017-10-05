/*
table 1: treasure_hunt_teams
	team - a three digit team number
	name1, roll1, phone1, name2, roll2, phone2
	pass - sha2 hash
*/

CREATE TABLE `treasure_hunt_teams` ( `team` INT(3) NOT NULL AUTO_INCREMENT , `name1` VARCHAR(25) NOT NULL , `roll1` BIGINT(10) NOT NULL , `phone1` BIGINT(10) NOT NULL , `name2` VARCHAR(25) NOT NULL , `roll2` BIGINT(10) NOT NULL , `phone2` BIGINT(10) NOT NULL , `pass` VARCHAR(64) NULL , PRIMARY KEY (`team`)) ENGINE = InnoDB;

ALTER TABLE treasure_hunt_teams AUTO_INCREMENT = 101;

/*
table 2: treasure_hunt_answers
	team - a three digit team number
	qno - a single digit question number
	answer1, answer2 - the recorded response to that question
	submitted - date and time of the last updation of that response
*/

CREATE TABLE `treasure_hunt_answers` ( `team` INT(3) NOT NULL REFERENCES `treasure_hunt_teams`(`team`), `qno` INT(1) NOT NULL , `answer1` VARCHAR(20) NOT NULL , `answer2` VARCHAR(20) NOT NULL , `submitted` DATETIME NOT NULL , PRIMARY KEY (`team`, `qno`)) ENGINE = InnoDB;