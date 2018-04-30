/* DDL for Task Manager*/
DROP TABLE IF EXISTS Users;
CREATE TABLE Users ( 
    userID      INT           NOT NULL  AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(255)  NOT NULL,
    userType    CHAR          COMMENT 'A - Admin, P - Public',
    password    VARCHAR(255)  NOT NULL,
    email       VARCHAR(255)  NOT NULL,
    numGroups   INT           
);
ALTER TABLE Users AUTO_INCREMENT=1000;

DROP TABLE IF EXISTS Groups;
CREATE TABLE Groups ( 
    groupID      INT          NOT NULL  AUTO_INCREMENT PRIMARY KEY,
    ownerID      INT          NOT NULL,
    groupName    VARCHAR(255) NOT NULL,
    numMembers   INT           
);
ALTER TABLE Groups AUTO_INCREMENT=1000;

DROP TABLE IF EXISTS Tasks;
CREATE TABLE Tasks ( 
    taskID       INT          NOT NULL  AUTO_INCREMENT PRIMARY KEY,
    ownerID      INT          NOT NULL,
    groupID      INT          NOT NULL,
    taskName     VARCHAR(255) NOT NULL,
    category     VARCHAR(255) NOT NULL,
    dueDate      DATETIME     NOT NULL,
    progress     VARCHAR(1023) ,
    priority     VARCHAR(10)  NOT NULL  COMMENT 'H - High, M - Medium, L - Low'
);
ALTER TABLE Tasks AUTO_INCREMENT=1000;

DROP TABLE IF EXISTS Category;
CREATE TABLE Category ( 
    catID        INT          NOT NULL  AUTO_INCREMENT PRIMARY KEY,
    catName      VARCHAR(255) NOT NULL,
    groupID    VARCHAR(255) NOT NULL,
    taskID       INT          NOT NULL
);
ALTER TABLE Category AUTO_INCREMENT=1000;