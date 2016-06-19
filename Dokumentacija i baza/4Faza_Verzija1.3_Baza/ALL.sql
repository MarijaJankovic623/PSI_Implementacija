CREATE TABLE `admin` (
  `IDAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `KIme` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Lozinka` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Ime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Prezime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `KodAdmina` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDAdmin`),
  UNIQUE KEY `KIme_UNIQUE` (`KIme`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;



CREATE TABLE `korisnik` (
  `IDKorisnik` int(11) NOT NULL AUTO_INCREMENT,
  `KIme` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Lozinka` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Ime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Prezime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`IDKorisnik`),
  UNIQUE KEY `KIme_UNIQUE` (`KIme`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;




CREATE TABLE `restoran` (
  `IDRestoran` int(11) NOT NULL AUTO_INCREMENT,
  `KIme` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Lozinka` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ImeObjekta` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ImeVlasnika` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `PrezimeVlasnika` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Opis` varchar(3000) CHARACTER SET utf8 DEFAULT NULL,
  `Kuhinja` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `Opstina` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Ocena` float DEFAULT '0',
  `KodKonobara` int(11) DEFAULT NULL,
  `BrojPosetilaca` int(11) DEFAULT '0',
  PRIMARY KEY (`IDRestoran`),
  UNIQUE KEY `KodKonobara_UNIQUE` (`KodKonobara`),
  UNIQUE KEY `KIme_UNIQUE` (`KIme`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;




CREATE TABLE `konobar` (
  `IDKonobar` int(11) NOT NULL AUTO_INCREMENT,
  `KIme` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Lozinka` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Ime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Prezime` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `IDRestoranFK` int(11) NOT NULL,
  PRIMARY KEY (`IDKonobar`),
  UNIQUE KEY `KIme_UNIQUE` (`KIme`),
  KEY `R_6` (`IDRestoranFK`),
  CONSTRAINT `R_6` FOREIGN KEY (`IDRestoranFK`) REFERENCES `restoran` (`IDRestoran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;



CREATE TABLE `sto` (
  `IDSto` int(11) NOT NULL AUTO_INCREMENT,
  `IDRestoranFK` int(11) NOT NULL,
  `BrojOsoba` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDSto`),
  KEY `R_7` (`IDRestoranFK`),
  CONSTRAINT `R_7` FOREIGN KEY (`IDRestoranFK`) REFERENCES `restoran` (`IDRestoran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;



CREATE TABLE `rezervacija` (
  `IDRezervacija` int(11) NOT NULL AUTO_INCREMENT,
  `IDStoFK` int(11) NOT NULL,
  `IDKorisnikFK` int(11) NOT NULL,
  `Status` varchar(50) DEFAULT 'Nadolazeca',
  `Ocena` int(11) DEFAULT '0',
  `VremeOd` timestamp NULL DEFAULT NULL,
  `VremeDo` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IDRezervacija`),
  KEY `R_8` (`IDStoFK`),
  KEY `R_9` (`IDKorisnikFK`),
  CONSTRAINT `R_8` FOREIGN KEY (`IDStoFK`) REFERENCES `sto` (`IDSto`),
  CONSTRAINT `R_9` FOREIGN KEY (`IDKorisnikFK`) REFERENCES `korisnik` (`IDKorisnik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;



CREATE TABLE `slika` (
  `IDSlika` int(11) NOT NULL AUTO_INCREMENT,
  `IDRestoranFK` int(11) DEFAULT NULL,
  `Putanja` varchar(3000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`IDSlika`),
  KEY `IDRestoranFK_idx` (`IDRestoranFK`),
  CONSTRAINT `IDRestoranFK` FOREIGN KEY (`IDRestoranFK`) REFERENCES `restoran` (`IDRestoran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DELIMITER $$
CREATE  PROCEDURE `ocena_restorana`(idRez INT)
BEGIN

DECLARE IDR int;
DECLARE  BP int;
DECLARE  O float;
DECLARE S varchar(100);
DECLARE ORez int;
DECLARE IDStoFK int;

SET S := (
SELECT R.Status
FROM rezervacija R
WHERE R.IDRezervacija = idRez);

SET ORez := (
SELECT R.Ocena
FROM rezervacija R
WHERE R.IDRezervacija = idRez);

SET IDStoFK := (
SELECT R.IDStoFK
FROM rezervacija R
WHERE R.IDRezervacija = idRez);




IF S ='Ocenjena'
THEN
BEGIN

SET IDR := (
SELECT S.IDRestoranFK
FROM sto S
WHERE S.IDSto = IDStoFK);



SET BP := (
SELECT R.BrojPosetilaca
FROM restoran R
WHERE R.IDRestoran = IDR);


SET O := (
SELECT  R.Ocena
FROM restoran R
WHERE R.IDRestoran = IDR);


SET O = O + ORez;

SET BP = BP + 1;

SET O = O / BP;

UPDATE restoran SET BrojPosetilaca = BP, Ocena = O WHERE IDRestoran = IDR;

END;
END IF;
END$$
DELIMITER ;



DELIMITER $$
CREATE  PROCEDURE `sve_rezervacije`(idK INT)
BEGIN

SELECT R.ImeObjekta, R.Opis, Z.Ocena, Z.VremeOd, Z.VremeDo,Z.Status, Z.IDRezervacija
FROM sto S, restoran R, rezervacija Z
WHERE Z.IDKorisnikFK = idK
AND  Z.IDStoFK = S.IDSto
AND S.IDRestoranFK = R.IDRestoran
;
END$$
DELIMITER ;


DELIMITER $$
CREATE  PROCEDURE `slobodni_stolovi`(idRes INT, brLjudi INT,vremeOd TIMESTAMP, vremeDo TIMESTAMP )
BEGIN

SELECT * 
FROM sto ss
WHERE ss.IDRestoranFK = idRes
AND ss.BrojOsoba = brLjudi
AND  ss.IDSto NOT IN
(
		SELECT  IDStoFK
		FROM rezervacija r
		WHERE 
        r.Status='Nadolazeca'
        AND
		(
			(vremeOd <= r.VremeDo AND vremeOd >= r.VremeOd )
			OR (vremeDo <= r.VremeDo AND vremeDo >= r.VremeOd)
			OR (vremeOd <= r.VremeOd AND vremeDo >= r.VremeDo)
		)
		AND  r.IDStoFK IN
			(
				SELECT s.IDSto 
				FROM sto s
				WHERE s.IDRestoranFK = idRes 
				AND s.BrojOsoba = brLjudi
			)
);

END$$
DELIMITER ;


DELIMITER $$
CREATE  PROCEDURE `slobodni_stolovi_restorani`(opstina VARCHAR(30) , brLjudi INT,vremeOd TIMESTAMP, vremeDo TIMESTAMP )
BEGIN
SELECT *
FROM restoran res
WHERE res.Opstina = opstina
AND EXISTS
(
SELECT * 
FROM sto ss
WHERE ss.IDRestoranFK = res.IDRestoran
AND ss.BrojOsoba = brLjudi
AND  ss.IDSto NOT IN
(
		SELECT  IDStoFK
		FROM rezervacija r
		WHERE
        r.Status='Nadolazeca'
        AND
		(
			(vremeOd <= r.VremeDo AND vremeOd >= r.VremeOd )
			OR (vremeDo <= r.VremeDo AND vremeDo >= r.VremeOd)
			OR (vremeOd <= r.VremeOd AND vremeDo >= r.VremeDo)
		)
		AND  r.IDStoFK IN
			(
				SELECT s.IDSto 
				FROM sto s
				WHERE s.IDRestoranFK = res.IDRestoran
				AND s.BrojOsoba = brLjudi
			)
)
);

END$$
DELIMITER ;


INSERT INTO `restooking_baza`.`admin`
(
`KIme`,
`Lozinka`,
`Ime`,
`Prezime`,
`Email`,
`KodAdmina`)
VALUES
(
'eAvengers',
'1234',
'eAvengers',
'eAvengers',
'eAvengers@gmail.com',
 1234);


INSERT INTO `restooking_baza`.`korisnik`
(
`KIme`,
`Lozinka`,
`Ime`,
`Prezime`,
`Email`)
VALUES
(
'gost',
'6666',
'zabranjeni',
'korisnik',
'gost@gmail.com');






