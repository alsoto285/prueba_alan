 /* Creamos la base de datos */
 create database prueba;
 /* Usamo la base creada */
 use prueba;
 /* Creamos tablas */
  /* Cat actegorias*/

 CREATE TABLE cat_usuario (id_usuario INT PRIMARY KEY auto_increment,  
			        nombre varchar(40),
                    telefono varchar(40),
                    email varchar(40),
                    pass longtext ,
                    rfc varchar(40),
                    notas varchar(100),
                    enable int (10));
                    /* inserta 2 uuarios */
 INSERT INTO cat_usuario (nombre, telefono, email, pass, rfc, notas, enable) 
VALUES ('Jose', '59890898', 'jo_@0910', '0d1a3925bed1c9e389a357ff0744a8b8a80a97221aa8c51fa5e7688a9e57a72a29fe29a1195464766a0085216f34343f78136e3ef12be7fb35afac82f0a8bf6e', 'ADMIN', 'nota', '1');

INSERT INTO cat_usuario (nombre, telefono, email, pass, rfc, notas, enable) 
VALUES ('alan', '50890898', 'alan@gmail.com', '0d1a3925bed1c9e389a357ff0744a8b8a80a97221aa8c51fa5e7688a9e57a72a29fe29a1195464766a0085216f34343f78136e3ef12be7fb35afac82f0a8bf6e', 'ALAM0990', 'nota', '1');
/* Inicio Stored Procedures */    
  /*Stored  que trae los usuarios activos*/   
DELIMITER %%
CREATE PROCEDURE strGetUser()
BEGIN
   select * from   cat_usuario where enable =1;    
END %%
DELIMITER ; 
 

 /*Stored  actualiza los datos de los usuarios */   
DELIMITER %%
CREATE PROCEDURE strUpdateUser(
		in _id_usuario int,
		in _nombre varchar (40),
		in _telefono varchar (40),
		in _email varchar (40),
		in _pass longtext,
		in _rfc varchar (40),
		in _notas varchar (100)
)
BEGIN

   UPDATE cat_usuario
   SET nombre = _nombre, telefono = _telefono, email = _email, pass = _pass, rfc = _rfc, notas = _notas
   WHERE (id_usuario = _id_usuario);
  SELECT "1" AS ALERT;
END %%
DELIMITER ; 

 /*Stored  validación de inicio de sesión de  usuarios activos*/   
DELIMITER %%
CREATE PROCEDURE strLoginUser(
		in _email varchar (40),
		in _pass longtext
		
)
BEGIN
  if  exists( select email from cat_usuario where email=_email and pass=_pass)THEN
   select nombre from cat_usuario where email=_email and pass=_pass;

  end if;
END %%
DELIMITER ; 

DELIMITER %%
CREATE PROCEDURE strCreateUser(
		in _nombre varchar (40),
		in _telefono varchar (40),
		in _email varchar (40),
		in _pass longtext,
		in _rfc varchar (40),
		in _notas varchar (100)
)
BEGIN
  INSERT INTO cat_usuario (nombre, telefono, email, pass, rfc, notas, enable) 
  VALUES (_nombre, _telefono, _email, _pass, _rfc, _notas, '1');

  SELECT "1" AS ALERT;
END %%
DELIMITER ; 

  /*Stored  que trae un usuario activos*/   
DELIMITER %%
CREATE PROCEDURE strGetUserinfo(
 in _id_user int
)
BEGIN
   select * from   cat_usuario where id_usuario =_id_user;    
END %%
DELIMITER ; 
 
	select * from cat_usuario ;
    
    
   