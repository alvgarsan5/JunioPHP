# Tarea RA4:
## Qué problema resuelve el mantenimiento de estado en aplicaciones web
El problema principal que hay es que HTTP no recuerda o no sabe cómo pasar información entre peticiones, pero para ello entiendo que lo resolvemos con el mantenimiento de estado en esta aplicación, es el hecho de que con las sesiones podemos recordar si el usuario ha iniciado sesión y, si esto lo juntamos con cookies, podemos guardar datos que podríamos almacenar y, de esta forma, tenerlos visibles cada vez que hagamos login durante el tiempo de vida que les demos a las cookies.

## Diferencia básica entre cookies y sesiones,
Mientras que la sesión permite mantener datos del usuario en el servidor, por ejemplo, saber si ha iniciado sesión, las cookies sirven para guardar datos durante el tiempo de vida que les demos a estas y se guardan en el navegador.

## Ventajas e inconvenientes de almacenar datos en cliente o en servidor
Las ventajas de almacenar datos en cliente son claras: recordamos datos para no estar repitiéndolos todo el rato, pero a la vez dejamos nuestros datos expuestos en el navegador.
Ventajas de almacenar datos en servidor: no hace falta estar haciendo login todo el rato, pero a cambio el programa ocupará más memoria al almacenar nuevos datos.

## Qué datos concretos guarda su aplicación en sesión y cuáles en cookie.
En sesión he pensado en guardar, de momento, el nombre de usuario, ya que con este dato ya podemos crear los condicionales para comprobar si hay un usuario logueado, puede pasar al index.php o no, cosa que se nos pide, y en cookie he pensado en guardar el nombre del aula y el tipo de incidencia, para comprobar cómo funcionaba en distintos tipos de campo en un formulario.

## Incluir 6–8 líneas sobre por qué HTTP es sin estado y por qué la aplicación necesita mecanismos adicionales para recordar información entre peticiones.
Lo que se entiende de que HTTP no tiene estado significa que cada vez que hacemos una petición sin los mecanismos adicionales adecuados (cookies y sesiones), este no guarda información; es decir, si le damos a reenviar la página en un formulario después de haberle dado al botón de enviar, si no tenemos cookies en algunos campos, estarían todos los campos en blanco, ya que el servidor no recuerda las peticiones que le hemos enviado anteriormente.

 Sin embargo, si tenemos cookies en algunos campos y le damos a refrescar, estos ya mostrarían las opciones que habíamos escogido anteriormente. Lo que conseguimos con las sesiones sería similar, porque ya tenemos recogidos los datos del usuario que hizo login; por lo tanto, podríamos poner la opción de que, si existe ya el dato de $_SESSION['usuario'], podemos programar en login.php que, si ya existe un usuario autenticado, redirija directamente a index.php sin mostrar el formulario de login otra vez, así es una experiencia más agradable para el usuario.