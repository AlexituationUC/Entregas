CREATE OR REPLACE FUNCTION
tres_mas_baratos(tipo varchar(255), tienda integer)

-- La idea es llamarla con "comestible" o "no comestible" y con el id de la tienda

RETURNS TABLE(
			   nombre varchar,
			   precio integer,
			   descripcion varchar
			   ) AS $$
BEGIN
IF tipo = 'comestible' THEN 
	RETURN QUERY (
	SELECT Productos.nombre, Productos.precio, Productos.descripcion
	FROM Productos, Comestibles, Tiendas, tienen
	WHERE Productos.id = Comestibles.id
	AND Tiendas.id = tienen.id_tiendas
	AND Productos.id = tienen.id_productos
	AND Tiendas.id = tienda
	ORDER BY Productos.precio
	LIMIT 3);
ELSE
RETURN QUERY (
	SELECT Productos.nombre, Productos.precio, Productos.descripcion
	FROM Productos, No_Comestibles, Tiendas, tienen
	WHERE Productos.id = No_Comestibles.id
	AND Tiendas.id = tienen.id_tiendas
	AND Productos.id = tienen.id_productos
	AND Tiendas.id = tienda
	ORDER BY Productos.precio
	LIMIT 3);
END IF;
END;

$$ LANGUAGE plpgsql;
