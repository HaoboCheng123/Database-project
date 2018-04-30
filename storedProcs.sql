DELIMITER //

CREATE PROCEDURE create_account(inName VARCHAR(255), inEmail VARCHAR(255), inPassword VARCHAR(255))
BEGIN
INSERT INTO Users (username, password, email) VALUES ('inName' , 'inPassword', 'inEmail');
END //
DELIMITER ;