# InstagramWEB
    -Debe ser una aplicación desarrollada en PHP como lenguaje del lado del servidor.
    -sar como base de datos MySQL o Maria DB.
    -HTML y CSS como lenguajes de marcado y diseño respectivamente.
    -Del lado del cliente usar javascript, con el cual debe hacer validaciones para los datos que se piden.
    -Para mejorar la experiencia del usuario, usar AJAX donde se considere conveniente.

# Cambios en login.html, registrarse.html y editarperfil.html - Shuy 11/04/2024 11:20 p. m.
    - Los ingresos de datos ahora estan en un form
    - los botones ahora estan en un form
    - El input de Genero ahora se cambio a select, se pueden seleccionar 4 opciones
    - El input en fecha de nacimiento se cambio a tipo date, se puede seleccionar la fecha

# Cambio login.html a login.php, agregado: connection, login_helper, sesion_requerida y sesion 
    - login lo cambié a php para usar el login como action del form 
    - connection.php es la conexión con la base de datos, funciona bien 
    - login_helper.php contiene la función de autenticar con los datos en la base de datos 
    - sesion_requerida.php funcionará para revisar en las demás páginas si la sesión ha sido iniciada 
    - sesion.php contiene los datos de sesión que se guardarán cuando se inici sesión 
    *NOTA: Aún no pruebo el inicio de sesión*