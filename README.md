- környezeti változók, amikkel az adatbázishoz csatlakozunk:

  - szte_oracle_username
  - szte_oracle_password

- ssh tunnel létrehozható a következő paranccsal, amely a kabineti adatbázishoz való csatlakozást lehetővé teszi otthonról:
  `./tunnel.sh [h-s azonosító]`

- a php szerver root könyvtára az a könyvtár kell legyen, amiben ez a README.md van. (pl: kicsomagolni az állományt direktben a htdocs-ba, hogy a _localhost/_ az azt a könyvtárt reprezentálja, amiben van ez a README.md)
- PHP 7.4.28
- oracle instant client 12
