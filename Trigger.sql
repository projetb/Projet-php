DROP TRIGGER IF EXISTS after_note_insert;

DELIMITER $$
CREATE TRIGGER after_note_insert
BEFORE INSERT ON Note
FOR EACH ROW
BEGIN
DECLARE MOY FLOAT;
SET MOY=(SELECT AVG(valeur) FROM Note WHERE album=new.album);
UPDATE Album
SET noteGeneral=MOY
WHERE idAlbum=new.album;
END $$
DELIMITER ;


DROP TRIGGER IF EXISTS after_note_update;

DELIMITER $$
CREATE TRIGGER after_note_update
BEFORE UPDATE ON Note
FOR EACH ROW
BEGIN
DECLARE MOY FLOAT;
SET MOY=(SELECT AVG(valeur) FROM Note WHERE album=new.album);
UPDATE Album
SET noteGeneral=MOY
WHERE idAlbum=new.album;
END $$
DELIMITER ;
