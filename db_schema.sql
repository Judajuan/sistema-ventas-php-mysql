DROP DATABASE IF EXISTS tienda_cafe;
CREATE DATABASE IF NOT EXISTS tienda_cafe;
USE tienda_cafe;
CREATE TABLE productos(
	codigo BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
	name VARCHAR(255) NOT NULL,
	categoria VARCHAR(255) NOT NULL,
	referencia VARCHAR(255) NOT NULL,
	Precio DECIMAL(5, 3) NOT NULL,
	Peso DECIMAL(5) NOT NULL,
	existencia INT(12) NOT NULL,
	fecha DATE NOT NULL ,
	PRIMARY KEY(codigo)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE ventas(
	codigo BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	fecha DATETIME NOT NULL,
	total DECIMAL(7,3),
	PRIMARY KEY(codigo)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE productos_vendidos(
	codigo_producto BIGINT UNSIGNED NOT NULL ,
	cantidad BIGINT UNSIGNED NOT NULL,
	codigo_venta BIGINT UNSIGNED NOT NULL,
	FOREIGN KEY(codigo_producto) REFERENCES productos(codigo) ON DELETE CASCADE,
	FOREIGN KEY(codigo_venta) REFERENCES ventas(codigo) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

INSERT INTO productos(codigo, name, categoria,referencia, Precio, Peso, existencia,fecha) 
VALUES
(1,  'Galletas chokis', 'Solidos' , 'Referencia 1', 15, 10, 100,date('Y-m-d H:i:s')),
(2,  'Mermelada de fresa', 'Liquidos' , 'Referencia 1', 80, 65, 100,date('Y-m-d H:i:s')),
(3, 'Aceite', 'Liquidos' , 'Referencia 1', 20, 18, 100,date('Y-m-d H:i:s')),
(4, 'Palomitas de maíz', 'Solidos' , 'Referencia 1', 15, 12, 100,date('Y-m-d H:i:s')),
(5, 'Doritos', 'Solidos' , 'Referencia 1', 8, 5, 100,date('Y-m-d H:i:s'));

# Correcto
