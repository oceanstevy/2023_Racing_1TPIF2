CREATE TABLE tblPlayer(
    idPlayer INT AUTO_INCREMENT PRIMARY KEY,
    dtName VARCHAR(255) NOT NULL UNIQUE,
    dtPassword VARCHAR(255) NOT NULL,
    fiCar INT NOT NULL DEFAULT 1
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

ALTER TABLE tblPlayer
    ADD CONSTRAINT FK_PlayerCar
        FOREIGN KEY (fiCar) REFERENCES tblCar (idCar)
            ON UPDATE CASCADE;









INSERT INTO tblCar( dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl)
VALUES (50,100,150,-25,3,50,3);

SELECT idCar, dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl
FROM tblCar
WHERE idCar = 1;

