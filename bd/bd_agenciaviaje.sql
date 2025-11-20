CREATE DATABASE IF NOT EXISTS bd_agenciaviaje;
USE bd_agenciaviaje;


CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    passwor VARCHAR(100) NOT NULL,
    Name VARCHAR(100)
);

INSERT INTO user (id, username, passwor, Name) VALUES
(1, 'admin', '123', 'Administrador');



CREATE TABLE viajero (
    cedula VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(150),
    direccion VARCHAR(255),
    telefono VARCHAR(20)
);

INSERT INTO viajero (cedula, nombre, direccion, telefono) VALUES
('6-722-932', 'Fernanda Perez', 'Calle Jose Pepe Burgos', '65654503'),
('8-962-683', 'Guillermo Navarro', 'Chitre, Ave. Centenario', '69648040');


CREATE TABLE destino (
    codigoDestino VARCHAR(20) PRIMARY KEY,
    cedulaViajero VARCHAR(20),
    nombreDestino VARCHAR(150),
    datosDestino VARCHAR(255),
    FOREIGN KEY (cedulaViajero) REFERENCES viajero(cedula)
);

INSERT INTO destino (cedulaViajero, codigoDestino, nombreDestino, datosDestino) VALUES
('6-722-932', '508', 'Costa Rica', 'Aeropueto de Rio Hato'),
('8-962-683', '555', 'EEUU', 'San Francisco, California');


CREATE TABLE origen (
    codigoOrigen VARCHAR(20) PRIMARY KEY,
    cedulaViajero VARCHAR(20),
    nombreOrigen VARCHAR(150),
    datosOrigen VARCHAR(255),
    FOREIGN KEY (cedulaViajero) REFERENCES viajero(cedula)
);

INSERT INTO origen (cedulaViajero, codigoOrigen, nombreOrigen, datosOrigen) VALUES
('8-962-683', '507', 'Panama', 'Desde el interior del pais'),
('6-722-932', '5077', 'Panama', 'Desde la cuidad');


CREATE TABLE reservacion (
    codigoReservacion VARCHAR(20) PRIMARY KEY,
    cedViajero VARCHAR(20),
    fecha VARCHAR(20),
    estado VARCHAR(20),
    FOREIGN KEY (cedViajero) REFERENCES viajero(cedula)
);

INSERT INTO reservacion (cedViajero, codigoReservacion, fecha, estado) VALUES
('8-962-683', '789', '11/3/2019', 'Activo'),
('6-722-932', '3214', '10/24/2019', 'Cancelada');


CREATE TABLE viajes (
    codigoViaje VARCHAR(20) PRIMARY KEY,
    numAsientos INT,
    costo DECIMAL(10,2),
    fecha VARCHAR(20),
    hora TIME,
    cedulaViajero VARCHAR(20),
    codigo_Origen VARCHAR(20),
    codigo_Destino VARCHAR(20),
    FOREIGN KEY (cedulaViajero) REFERENCES viajero(cedula),
    FOREIGN KEY (codigo_Origen) REFERENCES origen(codigoOrigen),
    FOREIGN KEY (codigo_Destino) REFERENCES destino(codigoDestino)
);

INSERT INTO viajes (codigoViaje, numAsientos, costo, fecha, hora, cedulaViajero, codigo_Origen, codigo_Destino) VALUES
('1001', 2, 956.99, '11/30/2019', '15:05:00', '8-962-683', '507', '555'),
('1002', 1, 1852.00, '10/24/2019', '10:56:00', '6-722-932', '5077', '508');
