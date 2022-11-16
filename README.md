Para utilizar la base de datos, se debe importar el archivo que se encuentra dentro de la carpeta 'database'.

ENDPOINTS:
Los diferentes endpoints que ofrece la API son los siguientes:

• Obtener todos los estudiantes: GET -> /students.

• Obtener un estudiante: GET -> /students/id (especificar id en la url).

• Agregar un nuevo estudiante: POST -> /student. 
Se requiere token y es necesario enviar en formato JSON, incluyendo los siguientes campos:  
    {
        "nombre": " ",
        "edad": ,
        "dni": ,
        "carrera_id": 
    }
Los id's de las carreras son:
    {
        Ingeniería En Sistemas: 1,
        TUDAI = 2,
        TUARI = 3,
        Prof. de Informática = 4,
        Prof. de Física = 5,
        Tecnologia de los alimentos =  16
    }

• Obtener token para agregar un estudiante -> GET -> /token | Se debe introducir en Basic Auth con el user y password: admin, admin. Despues se debe copiar el token e introducirlo en Bearer token al momento de hacer un POST.

PARAMETROS EN LA URL:

La API tiene distintos parametros que se indican con un ? al final de la url, que se utilizan para el paginado, la busqueda filtrada y el ordenamiento.

-sort="": indicando el orden, ascendente o descendente. Default ascendente.
field="": indicando el campo por el cual se desea ordenar. Default id.
Ej: http://localhost/web2/tpe2web/students?sort=asc&field=dni para ordenar de manera ascendente los dni de los estudiantes.

-where=: Se filtra para mostrar estudiantes que pertenecen a una carrera especificando la id de la misma.
Ej: http://localhost/web2/tpe2web/students?where=5 para mostrar los estudiantes que pertenecen a la carrera con el id 5.

-limit=: Se especifica la cantidad de estudiantes que se quieren visualizar como maximo. Default 18446744073709551610 (no se limita la cantidad).
Ej: http://localhost/web2/tpe2web/students?limit=1 muestra 1 solo estudiante como maximo.

-offset=: Debe ser usado en conjunto con limit, nos da la opcion de seleccionar la pagina que se desea ver con el listado de estudiantes. Default 0 (no pagina).
Ej: http://localhost/web2/tpe2web/students?limit=1&offset=5 estudiante de la pagina 5.


CODIGOS DE ERROR:
    Cuando realizamos alguna peticion o utilizamos la API puede que sucedan distintos errores, cada error esta asignado a un mensaje segun que numero sea:
    {
    200 => "OK",
    201 => "Created",
    400 => "Bad request",
    401 => "Unauthorized",
    403 => "Forbidden",
    404 => "Not found",
    500 => "Internal Server Error"
    }