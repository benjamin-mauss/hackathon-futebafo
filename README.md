# hackathon futebafo
hackathon 2020
### comandos sql para settar servidor
```
CREATE DATABASE hackathon_db;

use hackathon_db;

Create table users (
ID Int UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT Primary Key,
email Varchar(100) UNIQUE NOT NULL,
nick Varchar(40) UNIQUE NOT NULL,
senha Varchar(100) NOT NULL,
cards VARCHAR(2048)
);

```
