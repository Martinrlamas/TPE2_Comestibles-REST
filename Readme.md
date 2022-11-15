# Comestibles API

Endpoint de la API : **http://localhost/Comestibles-REST/api/products**

# Endpoints:

## Servicios GET

- `GET /products`: Accede al listado completo de productos que existen en la base de datos 'db_comestibles' dentro de la tabla 'productos'. 

    - #### Ordenamiento por campos
        
        - `GET /products?sort=FIELD&order=ORDERTYPE`  


        Agregando `?sort=FIELD&order=ORDERTYPE` permite ordenar la lista de manera ascendente o descendente por un campo. El campo se debe especificar en el `sort` y el orden deseado en el `order`. Solo es posible ordenar por campos existentes en la tabla de la base de datos, de lo contrario existira un `400 - Bad Request`.


        ***Ejemplo*** ```GET /products?sort=id&order=desc```  
        Este punto de entrada traera el listado de productos ordenado descendentemente por el campo `id`.

    - #### Paginacion

        - `GET /products?limit=value&pag=value`  

        A traves de los Query Params se pasa un limite que no puede exceder a la totalidad de registros de la tabla. Este limite establece la cantidad total de productos que se muestran por pagina, y para "recorrer" los registros se va aumentando el valor de la pagina. Si el limite no esta dentro de los posibles se producira un error `400 Bad Request`.

        ***Ejemplo*** `GET /products?page=3&limit=3`


            [
                {
                    "id": 11,
                    "producto": "Queso cremoso",
                    "precio": "899",
                    "id_categoria": 1,
                    "categoria": "Lacteos"
                },
                {
                    "id": 12,
                    "producto": "Manteca",
                    "precio": "463",
                    "id_categoria": 1,
                    "categoria": "Lacteos"
                },
                {
                    "id": 13,
                    "producto": "Queso crema",
                    "precio": "649",
                    "id_categoria": 1,
                    "categoria": "Lacteos"
                }
            ]

    - #### Filtrado
        - `GET /products?filter=value`

      Prestablecido por default en el campo de "productos", solo filtrara por ese campo las cadenas de string que coincidan con la peticion dada, de lo contrario se retornara un mensaje con "No se enecontro el detalle del producto" y un numero de error `404 Not found`.

        ***Ejemplo*** `GET /products?filter=as`  
        Esta peticion traera todos los productos que se encuentren con una cadena de string que posea `...as...`.


- `GET /products/:ID`: Este endpoint permite acceder a un producto especifico de la tabla dado un id particular. En caso de que el id sea incorrecto, se producira un error `404 Not Found`. 

- ***Ejemplo*** `GET /products/12`  


        {
            "id": 12,
            "producto": "Manteca",
            "precio": "463",
            "id_categoria": 1,
            "categoria": "Lacteos"
         }

***

## Servicio POST
- `POST /products`: Este servicio permite agregar un nuevo producto a la tabla a traves del body de `postman`

- ***Ejemplo*** `POST /products`  


    {
        "producto": "Garbanzos enlatados",
        "precio": "82",
        "id_categoria": 6,
        "categoria": "Enlatados"
    }

***

## Servicio DELETE
- `DELETE /products/:ID`
    Este servicio elimina el producto de la tabla cuyo id sea el que se pase por parametro. De no existir tal parametro ocurrira un mensaje con "El producto que desea eliminar no existe" y un codigo de error `404 Not found`.

- ***Ejemplo*** `DELETE /products/12`


    De existir ese producto la respuesta sera:
    "Producto eliminado"
    
    {
        "id": 12,
        "producto": "Manteca",
        "precio": "463",
        "id_categoria": 1,
        "categoria": "Lacteos"
    }

***
