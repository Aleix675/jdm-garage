# JDM Garage

Aplicació Laravel per a col·leccionistes de cotxes JDM dels anys 90-2000.

## Proposta de projecte

[Veure proposta completa](https://docs.google.com/document/d/1u3Vl9DU7RMrUAJVikv0BW-PmUNLjG-6x/edit?usp=drive_link&ouid=101529444129594237377&rtpof=true&sd=true)

## Instal·lació

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
```
