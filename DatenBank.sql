CREATE TABLE tblPlayer(
    idPlayer INT AUTO_INCREMENT PRIMARY KEY,
    dtName VARCHAR(255) NOT NULL UNIQUE,
    dtPassword VARCHAR(255) NOT NULL,
    fiCar INT NOT NULL DEFAULT 1,
    fiPermissionGroup TINYINT NOT NULL
);

CREATE TABLE tblCar(
    idCar INT AUTO_INCREMENT PRIMARY KEY,
    dtWidth smallint NOT NULL,
    dtHeight smallint NOT NULL,
    dtMaxSpeed smallint NOT NULL,
    dtMaxBackSpeed smallint NOT NULL,
    dtSpeedControl smallint NOT NULL,
    dtMaxAchse smallint NOT NULL,
    dtXAchsControl smallint NOT NULL
);

CREATE TABLE tblPermissionGroup (
    idPermissionGroup TINYINT AUTO_INCREMENT PRIMARY KEY,
    dtGroupName VARCHAR(30) NOT NULL
);

CREATE TABLE tblChat (
    idChat INT AUTO_INCREMENT PRIMARY KEY,
    fiPlayer INT NOT NULL,
    dtMessage VARCHAR(255) NOT NULL,
    dtTimestamp TIMESTAMP NOT NULL
);

ALTER TABLE tblPlayer
    ADD CONSTRAINT FK_PlayerCar
        FOREIGN KEY (fiCar) REFERENCES tblCar (idCar)
            ON UPDATE CASCADE,
    ADD CONSTRAINT FK_PlayerPermissionGroup
        FOREIGN KEY (fiPermissionGroup) REFERENCES tblPermissionGroup(idPermissionGroup)
            ON UPDATE CASCADE;

ALTER TABLE tblChat
    ADD CONSTRAINT FK_ChatPlayer
        FOREIGN KEY (fiPlayer) REFERENCES tblPlayer(idPlayer)
            ON UPDATE CASCADE;
# <<<<<<< HEAD
# =======
#     ADD CONSTRAINT FK_PlayerPermissionGroup
#         FOREIGN KEY (fiPermissionGroup) REFERENCES tblPermissionGroup(idPermissionGroup)
#             ON UPDATE CASCADE;
/* tblScore by Xu Yang */
CREATE TABLE tblScore(
    idScore INT AUTO_INCREMENT PRIMARY KEY,
    dtScore INT NOT NULL,
    fiPlayer INT
);
# >>>>>>> a1347ad557509fb867909d3f0fc62c17f20b6a17

ALTER TABLE tblScore
    ADD CONSTRAINT FK_ScorePlayer
    FOREIGN KEY (fiPlayer) REFERENCES tblPlayer (idPlayer)
    ON UPDATE CASCADE ;






INSERT INTO tblCar( dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl)
VALUES (50,100,150,-25,3,50,3);

INSERT INTO tblPermissionGroup
VALUES (NULL,'user'),
       (NULL,'admin');

INSERT INTO tblPlayer
VALUES (1,'Jonathan','42tg61Io2p1b6',1,1);

# SELECT idCar, dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl
# FROM tblCar
# WHERE idCar = 1;

