
-- Csapat: Hajagos Norbert & Kecskés László
create table EPULET (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 nev VARCHAR(255) NOT NULL,
 primary key(kod)
);


create table FELHASZNALO (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 jelszo VARCHAR(255) NOT NULL,
 keresztnev VARCHAR(255) NOT NULL,
 vezeteknev VARCHAR(255) NOT NULL,
 admin NUMBER(1) not null,
 primary key(kod)
);


create table TEREM (
 kod integer not null,
 nev VARCHAR(255),
 epulet_kod integer NOT NULL,
 FOREIGN KEY(epulet_kod) REFERENCES EPULET(kod),
 primary key(kod, epulet_kod)
);


create table LOG (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 felhasznalo_kod integer not null,
 bejelentkezesi_ido TIMESTAMP not null ,
 FOREIGN KEY(felhasznalo_kod) REFERENCES FELHASZNALO(kod),
 primary key(kod)
);


create table OKTATO (
 tanitas_kezdete TIMESTAMP NOT NULL,
 felhasznalo_kod integer not null,
 FOREIGN KEY(felhasznalo_kod) REFERENCES FELHASZNALO(kod),
 primary key(felhasznalo_kod)
);


create table HALLGATO (
 szemeszter integer NOT NULL,
 felhasznalo_kod integer not null,
 FOREIGN KEY(felhasznalo_kod) REFERENCES FELHASZNALO(kod),
 primary key(felhasznalo_kod)
);


create table KURZUS (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 nev VARCHAR(255) NOT NULL,
 max_letszam integer not null,
 oktato_kod integer,
 terem_kod integer not null,
 epulet_kod integer not null,
 FOREIGN KEY (oktato_kod) REFERENCES FELHASZNALO(kod),
 FOREIGN KEY (terem_kod, epulet_kod) REFERENCES TEREM(kod, epulet_kod),
 primary key(kod)
);


create table FELIRATKOZAS (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 hallgato_kod integer not null,
 kurzus_kod integer not null,
 FOREIGN KEY(hallgato_kod) REFERENCES HALLGATO(felhasznalo_kod),
 FOREIGN KEY (kurzus_kod) REFERENCES KURZUS(kod),
 primary key(kod)
);


create table BEJEGYZES (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 felhasznalo_kod integer not null,
 kurzus_kod integer not null,
 megiras_ideje TIMESTAMP NOT NULL,
 tartalom VARCHAR2(4000) not null,
 FOREIGN KEY(felhasznalo_kod) REFERENCES FELHASZNALO(kod),
 FOREIGN KEY(kurzus_kod) REFERENCES KURZUS(kod),
 primary key(kod)
);


create table HIRDETMENY (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 felhasznalo_kod integer not null,
 kurzus_kod integer not null,
 megiras_ideje TIMESTAMP NOT NULL,
 tartalom VARCHAR2(4000) not null,
 FOREIGN KEY(felhasznalo_kod) REFERENCES FELHASZNALO(kod),
 FOREIGN KEY(kurzus_kod) REFERENCES KURZUS(kod),
 primary key(kod)
);


create table TANANYAG (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 nev VARCHAR(255) NOT NULL,
 kurzus_kod integer not null,
 feltoltes_datum TIMESTAMP NOT NULL,
 tananyag BLOB not null,
 FOREIGN KEY(kurzus_kod) REFERENCES KURZUS(kod),
 primary key(kod)
);


create table VIZSGA (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 idopont TIMESTAMP NOT NULL,
 kurzus_kod integer not null,
 terem_kod integer not null,
 epulet_kod integer not null,
 FOREIGN KEY(terem_kod, epulet_kod) REFERENCES TEREM(kod, epulet_kod),
 FOREIGN KEY(kurzus_kod) REFERENCES KURZUS(kod),
 primary key(kod)
);



insert into epulet values ( DEFAULT,'TIK');
insert into epulet values ( DEFAULT,'IRINYI');
insert into epulet values ( DEFAULT,'BOLYAI');
insert into epulet values ( DEFAULT,'GÁBOR DÉNES ÉP.');
insert into epulet values ( DEFAULT,'CSONKA ÉP.');
insert into epulet values ( DEFAULT,'KLEBENSBERG KÖNYVTÁR');
insert into epulet values ( DEFAULT,'JÓZSEF ATTILA ÉP.');
insert into epulet values ( DEFAULT,'KLINIKÁK');
insert into epulet values ( DEFAULT,'ARANY JÁNOS ÉP.');
insert into epulet values ( DEFAULT,'BÉKE ÉP.');
insert into epulet values ( DEFAULT,'FELASZABADULÁS ÉP.');
insert into epulet values ( DEFAULT,'PRIDE ÉP.');
insert into epulet values ( DEFAULT,'REKTORI ÉP.');


insert into terem values ( 101,'nagyterem', 2 );
insert into terem values ( 102,'mellékterem', 2 );
insert into terem values ( 103,'', 2 );
insert into terem values ( 104,'segédterem', 2 );
insert into terem values ( 211,'', 3 );
insert into terem values ( 212,'iroda', 3 );
insert into terem values ( 213,'', 3 );
insert into terem values ( 214,'', 3 );
insert into terem values ( 215,'rendszergazda terem', 3 );
insert into terem values ( 01,'', 4 );
insert into terem values ( 02,'', 4 );
insert into terem values ( 03,'', 4 );
insert into terem values ( 04,'', 4 );
insert into terem values ( 05,'', 4 );



INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Tamás', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Peti', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'admin', 'Gazda', 'Rendszer', 1 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Fanni', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Ábel', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Leó', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Vice', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Petra', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Mária', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Dávid', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Viktor', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Csaknád', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Réka', 'Minta', 0 );
INSERT INTO felhasznalo (jelszo, keresztnev, vezeteknev, admin) VALUES ( 'asd123', 'Rita', 'Minta', 0 );


INSERT INTO oktato (tanitas_kezdete, felhasznalo_kod) VALUES ( CURRENT_TIMESTAMP, 2 );
INSERT INTO oktato (tanitas_kezdete, felhasznalo_kod) VALUES ( CURRENT_TIMESTAMP, 3 );
INSERT INTO oktato (tanitas_kezdete, felhasznalo_kod) VALUES ( CURRENT_TIMESTAMP, 4 );
INSERT INTO oktato (tanitas_kezdete, felhasznalo_kod) VALUES ( CURRENT_TIMESTAMP, 5 );
INSERT INTO oktato (tanitas_kezdete, felhasznalo_kod) VALUES ( CURRENT_TIMESTAMP, 6 );


INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 3, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 4, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 5, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 6, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 7, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 3, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 4, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 5, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 6, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 7, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 3, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 4, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 5, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 6, CURRENT_TIMESTAMP );
INSERT INTO log (felhasznalo_kod, bejelentkezesi_ido) VALUES ( 7, CURRENT_TIMESTAMP );



INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 4);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 5);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 6);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 7);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 8);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 9);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 10);
INSERT INTO hallgato (szemeszter, felhasznalo_kod) VALUES ( 1, 11);


INSERT INTO kurzus (nev, max_letszam, oktato_kod, terem_kod, epulet_kod) VALUES ( 'Statisztika', 30, 2, 102, 2 );
INSERT INTO kurzus (nev, max_letszam, oktato_kod, terem_kod, epulet_kod) VALUES ( 'Kertészet nem csak mikorbiológusoknak', 10, 2, 104, 2 );
INSERT INTO kurzus (nev, max_letszam, oktato_kod, terem_kod, epulet_kod) VALUES ( 'Felső fokú eszperente', 15, 3, 101, 2 );
INSERT INTO kurzus (nev, max_letszam, oktato_kod, terem_kod, epulet_kod) VALUES ( 'Önkifejezés JS könyvtár írással', 5, NULL, 215, 3 );
INSERT INTO kurzus (nev, max_letszam, oktato_kod, terem_kod, epulet_kod) VALUES ( 'Kalkulus I.', 100, NULL, 101, 2 );

create table FELIRATKOZAS (
 kod integer GENERATED BY DEFAULT AS IDENTITY,
 hallgato_kod integer not null,
 kurzus_kod integer not null,
 FOREIGN KEY(hallgato_kod) REFERENCES HALLGATO(felhasznalo_kod),
 FOREIGN KEY (kurzus_kod) REFERENCES KURZUS(kod),
 primary key(kod)
);


INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 4, 1 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 5, 1 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 6, 1 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 7, 1 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 8, 1 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 9, 1 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 4, 2 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 5, 2 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 8, 2 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 9, 2 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 4, 3 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 5, 3 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 6, 3 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 7, 3 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 8, 3 );
INSERT INTO feliratkozas (hallgato_kod, kurzus_kod) VALUES ( 9, 3 );

INSERT INTO hirdetmeny (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (2, 1, CURRENT_TIMESTAMP, 'fIGYELEM, SZEMESZTER NEMSOKÁRA KEZDŐDIK' );
INSERT INTO hirdetmeny (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (2, 1, CURRENT_TIMESTAMP, 'Elnézést, capslock' );
INSERT INTO hirdetmeny (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (2, 2, CURRENT_TIMESTAMP, 'Figyelem, nemsokára kezdődik a szemeszter! Nem akarom, hogy késsetek 1. óráról. Roppant fontots és komoly lesz' );
INSERT INTO hirdetmeny (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (3, 3, CURRENT_TIMESTAMP,  'Sziasztok! Én leszek az oktatótok');


INSERT INTO bejegyzes (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (2, 1, CURRENT_TIMESTAMP, 'fIGYELEM, SZEMESZTER NEMSOKÁRA KEZDŐDIK' );
INSERT INTO bejegyzes (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (2, 1, CURRENT_TIMESTAMP, 'Elnézést, capslock' );
INSERT INTO bejegyzes (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (4, 1, CURRENT_TIMESTAMP, 'Semmi gond :)' );
INSERT INTO bejegyzes (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (2, 2, CURRENT_TIMESTAMP, 'Figyelem, nemsokára kezdődik a szemeszter! Nem akarom, hogy késsetek 1. óráról. Roppant fontots és komoly lesz' );
INSERT INTO bejegyzes (felhasznalo_kod, kurzus_kod, megiras_ideje, tartalom) VALUES (3, 3, CURRENT_TIMESTAMP,  'Sziasztok! Én leszek az oktatótok');


INSERT INTO vizsga (idopont, kurzus_kod, terem_kod, epulet_kod ) VALUES (CURRENT_TIMESTAMP, 1, 104 ,2);
INSERT INTO vizsga (idopont, kurzus_kod, terem_kod, epulet_kod ) VALUES (CURRENT_TIMESTAMP, 2, 104 ,2);
INSERT INTO vizsga (idopont, kurzus_kod, terem_kod, epulet_kod ) VALUES (CURRENT_TIMESTAMP, 3, 4 ,4);
INSERT INTO vizsga (idopont, kurzus_kod, terem_kod, epulet_kod ) VALUES (CURRENT_TIMESTAMP, 4, 2 ,4);
INSERT INTO vizsga (idopont, kurzus_kod, terem_kod, epulet_kod ) VALUES (CURRENT_TIMESTAMP, 1, 1 ,4);
INSERT INTO vizsga (idopont, kurzus_kod, terem_kod, epulet_kod ) VALUES (CURRENT_TIMESTAMP, 1, 214 ,3);


grant select, insert, DELETE on BEJEGYZES to C##GK10ZO;
grant select, insert, DELETE on EPULET to C##GK10ZO;
grant select, insert, DELETE on felhasznalo to C##GK10ZO;
grant select, insert, DELETE on feliratkozas to C##GK10ZO;
grant select, insert, DELETE on hallgato to C##GK10ZO;
grant select, insert, DELETE on hirdetmeny to C##GK10ZO;
grant select, insert, DELETE on hirdetmeny to C##GK10ZO;
grant select, insert, DELETE on log to C##GK10ZO;
grant select, insert, DELETE on oktato to C##GK10ZO;
grant select, insert, DELETE on tananyag to C##GK10ZO;
grant select, insert, DELETE on terem to C##GK10ZO;
grant select, insert, DELETE on vizsga to C##GK10ZO;

