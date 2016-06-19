

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