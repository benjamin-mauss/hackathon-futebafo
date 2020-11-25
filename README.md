# hackathon futebafo
hackathon 2020
### comandos sql para settar db servidor
```
CREATE DATABASE hackathon_db;

use hackathon_db;

Create table if not EXISTS users  (
ID Int UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT Primary Key,
email Varchar(100) UNIQUE NOT NULL,
nick Varchar(40) UNIQUE NOT NULL,
senha Varchar(100) NOT NULL,
login_times Int DEFAULT 0 NOT NULL,
last_login_bonus int NOT NULL,
cards VARCHAR(2048)
);

```
