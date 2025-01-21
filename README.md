# LAJA-LOGIN

LAJA-LOGIN es un sistema de login desarrollado en PHP, diseñado para integrarse con el sistema de inventario LAJA-DB. Permite a los usuarios registrarse, iniciar sesión y gestionar su sesión de manera segura.

## Creditos
El desarrollo de LAJA-LOGIN ha sido posible gracias a la colaboración de los siguientes desarrolladores
- Adrian Rojas
- Alvaro Lara
- Juan Jordan
- Leizzy Goitia

## Características

- Registro de usuarios con validación de datos.
- Inicio de sesión seguro con verificación de contraseña.
- Gestión de sesiones para mantener a los usuarios autenticados.

## Requisitos

- PHP 8.1 o superior
- MySQL
- Servidor web (como Apache)
- Extensión PDO para PHP

## Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/radrian05/laja-login.git
   cd laja-login

2. **Ejecutar el script para crear la base de datos:**
   ```bash
   php dbsetup.php
