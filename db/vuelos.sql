DROP DATABASE airportdb; 

CREATE DATABASE airportdb; 

USE airportdb;

CREATE TABLE `airport` (
  `airport_id` smallint NOT NULL,
  `iata` char(3) DEFAULT NULL,
  `icao` char(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`airport_id`)
 ) ENGINE=InnoDB;
 
CREATE TABLE IF NOT EXISTS `airline` (
  `airline_id` smallint NOT NULL AUTO_INCREMENT,
  `iata` char(2)  NOT NULL,
  `airlinename` varchar(30)  DEFAULT NULL,
  `base_airport` smallint NOT NULL,
  PRIMARY KEY (`airline_id`),
  CONSTRAINT airline_fk FOREIGN KEY (base_airport) REFERENCES airport(airport_id)
) ENGINE=InnoDB ;

CREATE TABLE IF NOT EXISTS `airplane` (
  `airplane_id` int NOT NULL ,
  `capacity` mediumint unsigned NOT NULL,
  `type_id` int NOT NULL,
  `airline_id` smallint NOT NULL,
  PRIMARY KEY (`airplane_id`),
  CONSTRAINT airplane_fk FOREIGN KEY (airline_id) REFERENCES airline(airline_id)
) ENGINE=InnoDB ;

CREATE TABLE IF NOT EXISTS `flight` (
  `flight_id` int NOT NULL ,
  `flightno` char(8)  NOT NULL,
  `from_a` smallint NOT NULL,
  `to_a` smallint NOT NULL,
  `departure` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `airline_id` smallint NOT NULL,
  `airplane_id` int NOT NULL,
  PRIMARY KEY (`flight_id`),
  CONSTRAINT `flight_ibfk_3` FOREIGN KEY (`airline_id`) REFERENCES `airline` (`airline_id`),
  CONSTRAINT `flight_ibfk_4` FOREIGN KEY (`airplane_id`) REFERENCES `airplane` (`airplane_id`),
  CONSTRAINT `flight_ibfk_5` FOREIGN KEY (`from_a`) REFERENCES `airport` (`airport_id`),
  CONSTRAINT `flight_ibfk_6` FOREIGN KEY (`to_a`) REFERENCES `airport` (`airport_id`)
) ENGINE=InnoDB ;

CREATE TABLE IF NOT EXISTS `passengerdetails` (
  `passenger_id` int NOT NULL,
  `name` varchar(120) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` char(1)  DEFAULT NULL,
  `street` varchar(100)  NOT NULL,
  `city` varchar(100)  NOT NULL,
  `zip` smallint NOT NULL,
  `country` varchar(100)  NOT NULL,
  `emailaddress` varchar(120)  DEFAULT NULL,
  `telephoneno` varchar(30)  DEFAULT NULL,
  PRIMARY KEY (`passenger_id`)
 ) ENGINE=InnoDB;
 
 CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int NOT NULL,
  `flight_id` int NOT NULL,
  `seat` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passenger_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `seatplan_unq` (`flight_id`,`seat`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`passenger_id`) REFERENCES `passengerdetails` (`passenger_id`)
) ENGINE=InnoDB;



INSERT INTO `airport` VALUES (1,'CGN','EDDK','COLONIA'),(2,'BER','ADDB','BERLIN'),(3,'TIA','LATI','TIRANA'),(4,'VIE','LOWW','VIENA'),(5,'IBZ','LEIB','IBIZA'),(6,'MAD','LEMD','MADRID'),(7,'MRS','LFML','MARSELLA'),(8,'BCN','LEBL','BARCELONA'),(9,'GYD','UBBB','BAKU');


INSERT INTO `airline` VALUES (1,'AE','Air Europa',5),(2,'AL','Albania Airlines',3),(3,'AM','American Airlines',2);

INSERT INTO `airplane` VALUES (1,150,228,1),(2,200,38,1),(3,380,60,1),(4,50,232,2),(5,335,21,2),(6,115,48,2),(7,95,41,3),(8,115,48,3),(9,79,40,3),(10,95,41,3);

INSERT INTO `flight` VALUES 
(1,'AE1078',9,2,'2022-06-01 10:15:00','2022-06-01 20:46:00',1,3),
(2,'AE1377',4,1,'2022-06-01 23:41:00','2022-06-02 10:05:00',1,2),
(3,'AE1518',1,7,'2022-06-01 03:39:00','2022-06-01 11:13:00',1,1),
(4,'AE1593',6,4,'2022-06-02 00:02:00','2022-06-02 16:48:00',1,5),
(5,'AE1632',1,3,'2022-06-03 19:44:00','2022-06-04 09:22:00',1,3),
(6,'AL1748',2,6,'2022-06-01 08:31:00','2022-06-01 19:51:00',2,4),
(7,'AL1837',6,9,'2022-06-01 07:24:00','2022-06-01 18:51:00',2,5),
(8,'AL1908',5,8,'2022-06-01 05:47:00','2022-06-01 17:05:00',2,6),
(9,'AM2227',7,9,'2022-06-01 05:00:00','2022-06-01 18:19:00',3,7),
(10,'AM3068',8,1,'2022-06-01 06:00:00','2022-06-01 23:59:00',3,9),
(11,'AM3226',1,6,'2022-06-01 16:14:00','2022-06-02 06:43:00',3,10),
(12,'AM3230',4,1,'2022-06-01 07:38:00','2022-06-01 19:38:00',3,8);

INSERT INTO `passengerdetails` VALUES (1,'Michael Browne','1930-01-12','m','Andechsstrase 45','Bad Wimsbach-Neydharting',4654,'Ethiopia','Michael.Browne@airtelkol.com','03022 807190'),(2,'Mara Corday','1930-01-03','w','Archenweg 82','Behamberg',4441,'Korea','Mara.Corday@cvcpaging.com','01335 64343532'),(3,'Jack Greene','1930-01-07','m','Bichlweg 77','Bad Blumau',8283,'Korea','Jack.Greene@my2way.com','08165 15262423');

INSERT INTO `booking` VALUES (1,1,'21A',3,131.94),(2,2,'19H',1,500.63),(3,3,'16H',2,306.92),(4,5,'12B',2,400.12),(5,4,'9C',1,329.42),(6,9,'7G',2,423.36),(7,8,'3C',1,104.90);




