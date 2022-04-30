--------------------------------------------------------
--  File created - szombat-�prilis-30-2022   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table TEREM
--------------------------------------------------------

  CREATE TABLE "C##GK10ZO"."TEREM" 
   (	"KOD" NUMBER(*,0), 
	"NEV" VARCHAR2(255 BYTE), 
	"EPULET_KOD" NUMBER(*,0)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
REM INSERTING into C##GK10ZO.TEREM
SET DEFINE OFF;
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('989','B�k�tlen terem','30');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('556','ZH �r� terem','3');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('567','ZH �r� terem','2');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('342','N�v�nyvizsg�l�','7');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('753','M�t� terem','8');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('863','Olvas� terem','21');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('531','H�zi �r� terem','21');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('752','Nyugi terem','21');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('210','Sztocha terem','3');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('645','Kalkulus terem','3');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('763','Kicsi terem','9');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('689','Kicsi terem','30');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('839','K�nyes terem','26');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('249','K�lcs�nz�','26');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('887','Arany terem','9');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('204','Inf� terem','24');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('999','B�f�','24');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('534','Besz�lget�','33');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('101','nagyterem','2');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('102','mell�kterem','2');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('55','nagyobbterem','7');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('104','seg�dterem','2');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('214','IR-214','2');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('212','iroda','3');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('215','IR-215','2');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('111','kisterem','3');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('215','rendszergazda terem','3');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('432','Klinika terem','8');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('444','Csonka terem','10');
Insert into C##GK10ZO.TEREM (KOD,NEV,EPULET_KOD) values ('769','Felszabadul�s terem','31');
--------------------------------------------------------
--  DDL for Index SYS_C00130027
--------------------------------------------------------

  CREATE UNIQUE INDEX "C##GK10ZO"."SYS_C00130027" ON "C##GK10ZO"."TEREM" ("KOD", "EPULET_KOD") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  Constraints for Table TEREM
--------------------------------------------------------

  ALTER TABLE "C##GK10ZO"."TEREM" MODIFY ("KOD" NOT NULL ENABLE);
  ALTER TABLE "C##GK10ZO"."TEREM" MODIFY ("EPULET_KOD" NOT NULL ENABLE);
  ALTER TABLE "C##GK10ZO"."TEREM" ADD PRIMARY KEY ("KOD", "EPULET_KOD")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table TEREM
--------------------------------------------------------

  ALTER TABLE "C##GK10ZO"."TEREM" ADD FOREIGN KEY ("EPULET_KOD")
	  REFERENCES "C##GK10ZO"."EPULET" ("KOD") ENABLE;
