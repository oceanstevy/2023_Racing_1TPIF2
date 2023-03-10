CREATE TABLE tblPlayer(
    idPlayer INT AUTO_INCREMENT PRIMARY KEY,
    dtName VARCHAR(255) NOT NULL,
    dtPassword VARCHAR(255) NOT NULL,
    dtDisplayName VARCHAR(255) NOT NULL,
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
