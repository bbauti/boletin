# Proyecto Tecnica

Actualmente solo tengo terminado el sistema de autenticacion, es decir:

* Registro
* Inicio de sesion
* Sesiones entre navegadores
* 2FA
* Correos
* Magic Links


## 🔑 API Keys

Editar los siguientes keys necesarios para el funcionamiento de la app. Renombrar el archivo `.env.example` a `.env` en el root del proyecto.


| Parametro                  | Descripcion             |
|----------------------------|-------------------------|
| `APP_KEY`                  | Comando para crearlo: `php artisan key:generate`              |
| `DB_DATABASE`              | Nombre de la base de datos |
| `DB_PASSWORD`              | Contraseña de la base de datos |
| `MAIL_HOST`                | Proveedor del SMTP      |
| `MAIL_PORT`                | Puerto del SMTP         |
| `MAIL_USERNAME`            | Usuario del SMTP        |
| `MAIL_PASSWORD`            | Contraseña del SMTP     |
| `MAIL_FROM_ADDRESS`        | Encriptacion del SMTP   |
| `MAIL_USERNAME`            | Contraseña del SMTP     |
| `MAIL_USERNAME`            | Contraseña del SMTP     |


## 💻 Deployment

#### Dev

`Terminal 1`
```bash
$ npm install
$ npm run dev
```

`Terminal 2`
```bash
$ php artisan serve
```


## 📃 Documentation

Visita la [wiki del repo](https://github.com/bbauti/boletin/wiki)


## 🔧 Tech Stack

**Client:** VueJS, TailwindCSS, DaisyUI

**Server:** PHP, Laravel, InertiaJS

**Database:** PostgreSQL


## 📝 Feedback

Si tenes alguna sugerencia, no dudes en abrir un issue o un fork y enviar un pull request!

