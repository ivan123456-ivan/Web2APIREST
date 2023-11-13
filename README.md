# **Guia de uso API REST**

## Endpoints

------------

### *[GET] products/:ID*

#### Se utiliza para **obtener un producto en especifico** indicando su ID. En caso de no hacerlo se traerán todos los productos. Si el Producto no existe se mostrará un mensaje de error.

```json
          /api/products/32

          {
                    "id": "32",
                    "name": "BBQ Chicken Pizza",
                    "price": "16",
                    "stock": "7",
                    "id_categories": "6",
                    "id_shops": "11",
                    "product_image": "https://d104wv11b7o3gc.cloudfront.net/wp-content/uploads/2018/02/BBQ-chicken-crust-pizza-5-600x900.jpg",
                    "product_description": "Pizza with BBQ sauce, grilled chicken, mozzar"
          }
```

### *[GET] products*
#### **Devuelve todos** los productos encontrados en la base de datos.
```json
          /api/products
```

------------

### *[POST] products*
#### **Inserta un producto nuevo** en la base de datos siempre y cuando se **respeten los valores que requiere**.
```json
          /api/products
          {
                    "name": "Pizza",
                    "price": "4",
                    "stock": "100",
                    "id_categories": "6",
                    "id_shops": "11",
                    "product_image": "https://d104wv11b7o3gc.cloudfront.net/wp-content/uploads/2018/02/BBQ-chicken-crust-pizza-5-600x900.jpg",
                    "product_description": "Pizza, grilled chicken, mozzar"
          }
```

------------

### *[PUT] products/:ID* 
#### Se **edita un producto especifico** indicando su ID por parámetro. Se **requiere que se completen todos los campos** para su correcta edición.

```json
          /api/products/:ID
          {
                    "name": "Pizza editada",
                    "price": "3",
                    "stock": "63",
                    "id_categories": "6",
                    "id_shops": "11",
                    "product_image": "https://d104wv11b7o3gc.cloudfront.net/wp-content/uploads/2018/02/BBQ-chicken-crust-pizza-5-600x900.jpg",
                    "product_description": "Pizza, grilled chicken, mozzar editada"
          }
```
------------

### *[DELETE] products/:ID*
#### Se **elimina un producto** que exista en la base de datos. Una vez eliminado no se puede recuperar el producto eliminado.

```json
          /api/products/:ID
```

------------

### *Métodos de ordenamiento:*

#### - **?sort_by**: *Dicho parámetro debe indicar un nombre de una columna existente en la base de datos.* 

#### - **?order**: *Se debe indicar si se desea ordenar de forma ascendente o descendente. De forma ascendente (`ASC`) se utiliza indicando con 1 y cualquier otro valor numérico se utiliza de forma descendente (`DESC`).* 

------------

### *Métodos de filtrado:*

#### - **?category**: *Se debe indicar el número correspondiente a un ID de una categoría existente en la base de datos.*

------------

### *Métodos de Paginado:*

#### - **?page**: *Se debe especificar el número de pagina que se desea obtener (**empezando por la 0**). Cabe aclarar que este método no es compatible para combinar con los otros métodos. En caso de indicar caracteres **no numéricos** se devolverá la lista completa de los productos sin aplicar el paginado.*

#### - **?limit**: *Se puede detallar un cierto número el cuál representa el límite de los resultados que se desea obtener. **Este límite por defecto es 5**.*