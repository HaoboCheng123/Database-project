DELIMITER //
CREATE TRIGGER `after_groups_insert` AFTER INSERT ON  Groups
FOR EACH
ROW BEGIN 
INSERT INTO Members (userID, groupID) VALUES (new.ownerId, new.groupID);
END //
DELIMITER ;