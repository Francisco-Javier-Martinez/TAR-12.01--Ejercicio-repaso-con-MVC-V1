-- usuario con permisos normales ( Este lo que podra hacer son interacciones de usuario por defecto)
CREATE USER 'user_Normal'@'localhost' IDENTIFIED BY '123456';
GRANT SELECT, INSERT, UPDATE, DELETE ON deportes.* TO 'user_Normal'@'localhost'; 
-- este usario tendra los siguientes permisos porque es una persona normal y puede consultar cosas,
-- registrarse actualizar sus datos y darse de baja

-- usuarios con todos los privilegios ( Para poder comprobar todo)
CREATE USER 'user_Admin'@'localhost' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON deportes.* TO 'user_Admin'@'localhost';
-- este sera un usuario con todos los privilegios para que tenga acceso 
-- para realizar todas las funciones necesarias para la aplicacion


-- usuario que solo podra hacer selects este no quiero que pueda hacer la inscripcion
CREATE USER 'user_select'@'localhost' IDENTIFIED BY 'consulta123';
GRANT SELECT ON deportes.* TO 'user_select'@'localhost';
-- este usuario lo quiero para aquellos usuarios que no quiero que se puedan resgistrar
-- que solo puedan consultar los datos

