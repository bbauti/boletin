## 📃 Registro

### ¿Como funciona el registro?

El sistema de registro se compone de acciones, reglas de validación de contraseñas, vistas y características de seguridad.

1. **Acciones**: Las acciones son clases que gestionan tareas específicas. La clase `CreateNewUser` se encarga de registrar usuarios, validando la entrada y creando cuentas.

2. **Reglas de Validación de Contraseñas**: Las acciones de registro utilizan el trait<sup>[1](#1)</sup> `PasswordValidationRules` para definir reglas de contraseña. Pudiendose personalizar requisitos como longitud, mayúsculas, números y caracteres especiales.
Ejemplos:
    ```php
    use Laravel\Fortify\Rules\Password;

    // Debe tener al menos 10 caracteres...
    (new Password)->length(10)

    // Debe tener al menos una letra en mayuscula...
    (new Password)->requireUppercase()

    // Debe tener al menos un numero...
    (new Password)->requireNumeric()

    // Debe tener al menos un caracter especial...
    (new Password)->requireSpecialCharacter()
    ```


3. **Vistas/Páginas**: Para las vistas, se utilizan las vistas de Vue.js de Inertia como resources/js/Pages/Auth/Register.vue. Una vista es la representación visual de los datos y la interfaz de usuario que los usuarios ven en su navegador.

5. **Verificación de Correo Electrónico**: Los usuarios recibirán un correo para verificar su dirección después del registro. Para esto se usa el servicio de SMTP que hayamos elegido, en mi caso Resend, y se implementa la verificacion de Correo Electronico incorporando la interface<sup>[2](#2)</sup> `Illuminate\Contracts\Auth\MustVerifyEmail`.

---

### Glosario

<h4 id="1">1: Traits</h4>
Los rasgos (traits) son una forma de reutilizar código en programación, permitiendo compartir métodos entre diferentes clases sin las complicaciones de la herencia múltiple. Simplifican la combinación de métodos en clases independientes.

<h4 id="2">2: Interfaces</h4>