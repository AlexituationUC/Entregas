CREATE OR REPLACE FUNCTION
vendidos_por_tienda(tienda integer, producto varchar)
RETURNS TABLE(
			   id integer,
			   nombre varchar,
			   descripcion varchar,
			   precio integer
			   ) AS $$

-- La idea es determinar si es que son comestibles o no comestibles con PHP, verificando si
-- el id del producto está en comestibles o en no comestibles

BEGIN
RETURN (
	SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio
	FROM Productos, Tiendas, tienen
	WHERE Productos.id = tienen.id_productos 
	AND Tiendas.id = tienen.id_tienda
	AND LOWER(Productos.nombre) LIKE LOWER(FORMAT('%s%', producto))
	AND Tiendas.id = tienda
	);
END;

$$ LANGUAGE plpgsql;
