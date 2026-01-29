-- añadir un campo imagen a la tabla deporte sin que alteremos los datos que esten en la bd
alter table deportes
  add imagenDeportes MEDIUMBLOB null; -- en mysql se usa el blob y decidi meterle un mediumblob esto si se va a guardar la 
  --imagen en la guardada en la bd

-- si vamos a añadir la imagen que se guarde en una carpeta del servidor guardaremos el nombre
-- vamos a quitar el valor mediumblob por un varchar donde ser guardara el nombre dela img
alter table deportes
  MODIFY imagenDeportes varchar(150) null;

-- se va a filtrar por deprtes en varios sitios aparte no queremos que el deporte se repita
-- asi que vamos a crear un indice unico para este campo
CREATE UNIQUE INDEX ind_unq_Deportes on deportes(nombreDep);

-- ver si se creo bien
SHOW INDEX FROM deportes

-- ahora nos hemos dado cuenta que si que necesitamos que en un momento muy oportuno 
-- necesitamos que el nombre si se repita 
alter table deportes
	drop INDEX ind_unq_Deportes;

-- pero si queremos que siga siendo un indice de busca pero no unico 
create INDEX ind_Deportes on deportes(nombreDep);

-- durante un estudio hemos decidido que la imagen no saldra de la base de datos mediante una votacion 
-- han decidido remover el camp imagen del deporte
ALTER TABLE deportes
  DROP COLUMN imagenDeportes;

-- ahora los usuarios tendran un perfil mas que es el de lector(l) tenemos que añadirlo
ALTER TABLE Usuarios 
  MODIFY COLUMN perfil ENUM('c', 'u', 'l') NOT NULL;

-- para commprobar si todo fue bien hacemos un show de la columna

show COLUMNS from usuarios 

-- necesitamos q en el resgistro se guarde la fecha y hora la la inscripcion que sea la del sistema
alter table Usuarios_deportes
  add fechaInscripcion timestamp DEFAULT CURRENT_TIMESTAMP not null;

-- esta le falta las fk se las vamos a añadir
CREATE TABLE Usuarios_deportes (
	idDeporte 	tinyint unsigned	NOT NULL,
	idUsuario 	smallint unsigned	NOT NULL,
	PRIMARY KEY (idDeporte, idUsuario),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE Usuarios_deportes
	ADD CONSTRAINT fk_idDeporte 
			FOREIGN KEY (idDeporte) REFERENCES deportes(idDeporte);

ALTER TABLE Usuarios_deportes
	ADD CONSTRAINT fk_Usuario
			FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario);

-- nos hemos dado cuentea que en deporte queremos que tenga delete cascade y update cascade
ALTER TABLE Usuarios_deportes
  drop CONSTRAINT fk_idDeporte;
-- ponerlo 
ALTER TABLE Usuarios_deportes
	ADD CONSTRAINT fk_idDeporte 
			FOREIGN KEY (idDeporte) REFERENCES deportes(idDeporte) on DELETE CASCADE on UPDATE CASCADE;
