3NF

KURZUS
**kod**
nev
max*letszam
\_OKTATO.kod
TEREM.kod
EPULET.kod*

FELIRATKOZAS
**feliratkozas_id**
_KURZUS.kod
HALLGATO.kod_

HALLGATO
_**FELHASZNALO.kod**
_ szemeszterek

OKTATO
_**FELHASZNALO.kod**
_ tanitast_kezdte

FELHASZNALO
**kod**
vezeteknev
keresztnev
admin
jelszo

TEREM
**kod**
gyenge _EPULET.kod_ nev

EPULET
**kod** nev

LOG
**kod**
_FELHASZNALO.kod_
bejelentkezesi_ido

BEJEGYZÉS
**kod**
tartalom
megiras*ideje
\_FELHASZNALO.kod*
_KURZUS.kod_

HIRDETMÉNY
**kod**
tartalom
megiras*ideje
\_FELHASZNALO.kod*
_KURZUS.kod_

TANANYAG
**kod**
nev
feltöltés*datum
tananyag
\_KURZUS.kod*

VIZSGA
**kod**
időpont
_TEREM.kod
EPULET.kod_
_KURZUS.kod_)
