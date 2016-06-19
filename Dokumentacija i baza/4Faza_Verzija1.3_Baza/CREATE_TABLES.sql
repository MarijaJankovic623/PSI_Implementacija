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

