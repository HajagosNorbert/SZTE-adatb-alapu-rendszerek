# Specifikáció
Kell egy olyan Elektronikus Tanulmányi Rendszer (ETR), amely kisebb egyetemeknek készül és teljes mértékben irányítható / moderálható egy adminisztrátor által. Az oktatók a felületen megszervezik a kurzusaikat, az ahhoz tartozó tananyagokat és plusz információt biztosítják a hallgatókank. A rendszer felületet nyújt a hallatók számára a kurzusfelvételnek, tananyagszerzésnek. A kurzusoknak része egy fórum, ahol hallgatók és oktatók közösen kommunikálhatnak egy üzenőfalon.

# Követelmény katalógus

## Funkcionális elvárások

### Minden felhasználó

Személyes adatait módosíthatja, megtekintheti.
Egy felhasználó lehet:
1. oktató
2. hallgató
3. phd (hallgató & oktató egyszerre)
4. admin

### Oktatók
Oktatók létre tudnak hozni kurzusokat. Mellékelni tudnak hozzájuk tananyagot fájlként, hirdetményeket tudnak publikálni és írhatnak a kurzusfórumba bejegyzéseket. Ezen elemeknek megváltoztathatják a tulajdonságait, amennyiben ők a tulajdonosai vagy törölhetik azokat.
Oktató nélküli kurzusokra is jelentkezhetnek. Lemondhatják a saját kurzusaikat, így oktató nélküli kurzus lesz belőlük.
Megtekinthetik kik iratkoztak fel a kurzusaikra.

### Hallgatók
Megtekinthetnek, valamint fel és le jelentkezhetnek kurzusokra. Felíratkozott kurzusoknak írhatnak bejegyzéseket a kurzusfórumra, sajátjukat megváltoztathatják és törölhetik, vaamint letölthetik a mellékelt tananyagokat.

### Admin
Felhasználókat, kurzusokat, tananyagot, bejegyzéseket, hirdetményeket, termeket és a hozzájuk tartozó épületeket vehet fel, módosíthat vagy törölhet ki. Akár a felhasználók típusát is megváltoztathatja. Új szemesztert deklarálhat.
Megtekintheti a logokat arról, hogy ki-mikor lépet be a rendszerbe, illetve mikor volt az utolsó bejelentkezés arra az esetre, ha ki szeretné törölni a régi felhasználókat. Tudja törölni az összes logbejegyzést egy mozdulattal.

A legrégebb óta az egyetemnél tanító oktató évente kap köszönetnyilvánítást. Az admin tudja könnyen, hogy ki ez a oktató.

## Nem funkcionális elvárások

- Bejelentkezés felhasználói azonosítóval és jelszóval történik.
- A kezdőoldal a bejelentkezési felület, vagy ha bejelentkezett felhasználóról van szó, akkor a kurzusok nézet.
- Ha nem bejelentkezett, vagy jogtalan felhasználó tekintene meg egy oldalt, legyen visszairányítva a kezdőoldalra.
- A felhasználói jelszavak biztonságos módon legyenek eltárolva.
- Az adatok módosítása legyen kényelmes, egy űrlap kitöltése ne igényeljen olyan adatok begépelését, amit nem szándékozunk megváltoztatni. 
- PHD felhasználók ne jelentkezhessenek olyan kurzusra, amit ők tartanak és törlődjenek a hallgatólistáról, amennyibe vállalnak egy kurzust, amire már felvoltak jelentkezve.
- Admin által létrehozott kurzusok oktató nélküli kurzusok lesznek
- oktató jog megvonásánál és oktató felhasználó kitörlésénél a következő jogosultságok lépnek életbe:
  - Hirdetmények és bejegyzések nem törölhetők / módosíthatók más által, még új oktató esetén sem. Azok a kurzus törléséig ott lesznek. (vagy amíg az admin el nem távolítja őket)
  - A tananyagok a kurzushoz tartoznak. Bárki is az oktatója, teljes jogot kap felettük.

- Oktatói jog megvonásánál és oktató felhasználó kitörlésénél a következő történik:
  - A kurzus, amiket tanítottak oktató nélkül maradnak

- Hallgatói jog megvonásánál és hallgató felhasználó kitörlésénél a következő történik:
  - Automatikusan leíratkozik a kurzusokról
  - A kurzusfórumi bejegyzések ott maradnak, amíg a kurzus ki nem törlődik (vagy az admin el nem távolítja őket)

- Egy Épület kitörlése maga után vonja a tantermek kitörlését, viszont a tantermek kitörlése üres értékre állítja a kurzusok `helyszín`e tulajdonságát, amennyiben ott lett volna megtartva az.
- Terem vagy épület kódjának megváltoztatásánál (PL: TIK-A001 átírásra kerül IR-225 -ra) szintén üres értéket vesz fel a kurzusok `helyszín` tulajdonsága, amennyiben ott lett volna megtartva az.
- Egy kurzus csak megerősítést követően törölhető, ami után törlődik minden felíratkozás, oktatói tananyag, hírdetmény, bejegyzés.
- Mindig legyen legalább egy admin felhasználó. Ha az utolsó admin felhasználó törlődne ki, azt akadályozza meg a rendszer.