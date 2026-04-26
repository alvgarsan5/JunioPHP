# Parte 1 – RA1: Arquitecturas y tecnologías en entorno servidor

## ¿Cómo funciona?

Primero que todo, he creado el contenedor en Docker para poder ejecutar el código PHP y poder visualizar lo que quiero ver en el navegador y que este compile bien.

Una vez tenemos ya el contenedor de Docker corriendo, lo que vemos es el formulario que hemos construido con código. Al rellenar este formulario con las incidencias del aula y darle al botón de enviar, mandamos una petición HTTP usando el método POST. 

Esa petición viaja por la red y llega a nuestro servidor web (Nginx). Como Nginx ve que es un archivo .php y no sabe procesarlo, se lo pasa al intérprete de PHP. 

Aquí entra PHP en juego: si los datos que hemos introducido han pasado las condiciones y se consideran datos correctos, PHP recoge los datos que le hemos mandado por el formulario, hace los cálculos para sacar nuestro nivel de criticidad y genera un código HTML normal y corriente. 

Por último, el servidor coge ese HTML ya renderizado y nos lo devuelve al navegador, y ahí es cuando vemos el resumen en nuestra pantalla.

## ¿Por qué PHP y un servidor HTTP para esta aplicación?
He pensado que PHP junto a un servidor web es lo ideal para una "mini-calculadora". No es necesario utilizar frameworks como Laravel ya que no vamos a tener que hacer cosas muy densas, de hecho nos da la opción de imprimir todo en la misma página simplificando aún más la faena; no hace falta utilizar ni sesiones en este caso. 
## Esquema rápido

```text
  [ MI NAVEGADOR ]                                  [ SERVIDOR (Nginx) ] 
     (Cliente)                                                |          
         |                                                    |          
         | -- 1. Envío el form por HTTP (POST) ------------>  |          
         |                                                    | -- 2. Pasa el '.php' a -> [ Intérprete PHP ]
         |                                                    |                            (Hace los cálculos)
         |                                                    | <--- 3. Devuelve HTML --- 
         | <--- 4. Respuesta HTTP (Página HTML lista) ------  |          
```
