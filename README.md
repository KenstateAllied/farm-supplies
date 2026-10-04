# br

<img src="https://img.shields.io/github/license/ipang-dwi/xdesktop.svg" /> <img src="https://img.shields.io/badge/lab-firstplato.com-red.svg" /> <img src="https://img.shields.io/badge/need-donation-brightgreen.svg" />

Web Based Trucking System with Native PHP and PostgreSQL - www.firstplato.com

## PostgreSQL setup

The application requires PHP with the PDO PostgreSQL extension (`pdo_pgsql`) and
a PostgreSQL database. Create the database (for example, `br`), then load the
schema from the repository root:

```sh
psql -U postgres -d br -f schema.sql
```

Configure the connection using these environment variables:

| Variable | Default |
| --- | --- |
| `PGHOST` | `localhost` |
| `PGPORT` | `5432` |
| `PGDATABASE` | `br` |
| `PGUSER` | `postgres` |
| `PGPASSWORD` | empty |

The schema creates the `mobil`, `"user"`, and `setting` tables, including an
initial settings row. It does not create an administrator account. Existing
MySQL/MariaDB data must be migrated separately and imported into these tables;
preserve primary keys when importing and reset the corresponding identity
sequences to the imported maximum IDs.

Feel free to reach me on :
- https://www.firstplato.com
- https://www.facebook.com/firstplato
- admin@firstplato.com
