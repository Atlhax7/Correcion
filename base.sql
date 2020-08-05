/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2020-07-30 3:31:50 PM                        */
/*==============================================================*/


DROP TABLE IF EXISTS ROL_MODULO;

DROP TABLE IF EXISTS SEG_FUNCIONALIDAD;

DROP TABLE IF EXISTS SEG_MODULO;

DROP TABLE IF EXISTS SEG_ROL;

/*==============================================================*/
/* Table: ROL_MODULO                                            */
/*==============================================================*/
CREATE TABLE ROL_MODULO
(
   COD_ROL              VARCHAR(5) NOT NULL,
   COD_MODULO           VARCHAR(16) NOT NULL COMMENT 'C�digo identificador del m�dulo',
   PRIMARY KEY (COD_ROL, COD_MODULO)
);

/*==============================================================*/
/* Table: SEG_FUNCIONALIDAD                                     */
/*==============================================================*/
CREATE TABLE SEG_FUNCIONALIDAD
(
   COD_FUNCIONALIDAD    INT NOT NULL AUTO_INCREMENT COMMENT 'C�digo identificador de la funcionalidad autonum�rico.',
   COD_MODULO           VARCHAR(16) NOT NULL COMMENT 'C�digo identificador del m�dulo al que pertenece la funcionalidad.',
   URL_PRINCIPAL        VARCHAR(200) NOT NULL COMMENT 'Especifica URL principal de la funcionalidad.',
   NOMBRE               VARCHAR(200) NOT NULL COMMENT 'Nombre Descriptivo de la funcionalidad.',
   DESCRIPCION          VARCHAR(500) COMMENT 'Breve explicaci�n sobre la funcionalidad.',
   PRIMARY KEY (COD_FUNCIONALIDAD)
);

ALTER TABLE SEG_FUNCIONALIDAD COMMENT 'Almacena todas las funcionalidades del sistema. Una funciona';

/*==============================================================*/
/* Table: SEG_MODULO                                            */
/*==============================================================*/
CREATE TABLE SEG_MODULO
(
   COD_MODULO           VARCHAR(16) NOT NULL COMMENT 'C�digo identificador del m�dulo',
   NOMBRE               VARCHAR(50) NOT NULL COMMENT 'Nombre del m�dulo',
   ESTADO               VARCHAR(3) NOT NULL DEFAULT 'ACT' COMMENT 'Estado del m�dulo; especifica la habilitaci�n de uso.
            ACT Activo
            INA Inactivo',
   PRIMARY KEY (COD_MODULO)
);

ALTER TABLE SEG_MODULO COMMENT 'Contiene los diferentes m�dulos del sistema.';

/*==============================================================*/
/* Table: SEG_ROL                                               */
/*==============================================================*/
CREATE TABLE SEG_ROL
(
   COD_ROL              VARCHAR(5) NOT NULL,
   NOMBRE               VARCHAR(100) NOT NULL,
   PRIMARY KEY (COD_ROL)
);

ALTER TABLE ROL_MODULO ADD CONSTRAINT FK_REFERENCE_3 FOREIGN KEY (COD_MODULO)
      REFERENCES SEG_MODULO (COD_MODULO) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE ROL_MODULO ADD CONSTRAINT FK_ROLMOD_A_ROL FOREIGN KEY (COD_ROL)
      REFERENCES SEG_ROL (COD_ROL) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE SEG_FUNCIONALIDAD ADD CONSTRAINT FK_FUNCIONALIDAD_A_MODULO FOREIGN KEY (COD_MODULO)
      REFERENCES SEG_MODULO (COD_MODULO) ON DELETE RESTRICT ON UPDATE RESTRICT;

--INSERTS
insert into SEG_ROL VALUES('ADMIN','ADMINISTRADOR');
insert into SEG_ROL VALUES('DOCE','DOCENTE');
insert into SEG_ROL VALUES('ALUM','ALUMNO');

select * from seg_rol, rol_modulo, seg_modulo,seg_funcionalidad;
