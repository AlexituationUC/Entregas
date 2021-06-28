CREATE OR REPLACE FUNCTION
tres_mas_baratos(tipo varchar, tienda integer)
RETURNS TABLE(
			   nombre varchar,
			   precio integer,
			   descripcion varchar
			   ) AS $$
BEGIN
IF tipo == "comestible" THEN 
	RETURN (
	SELECT Productos.nombre, precio, descripcion
	FROM Productos, Comestibles, Tiendas, tienen
	WHERE Productos.id = Comestibles.id
	AND Tiendas.id = tienen.id_tiendas
	AND Productos.id = tienen.id_productos
	AND Tiendas.id = tienda
	ORDER BY precio
	LIMIT 3);
ELSE
RETURN (
	SELECT Productos.nombre, precio, descripcion
	FROM Productos, No_Comestibles, Tiendas, tienen
	WHERE Productos.id = No_Comestibles.id
	AND Tiendas.id = tienen.id_tiendas
	AND Productos.id = tienen.id_productos
	AND Tiendas.id = tienda
	ORDER BY precio
	LIMIT 3);
END IF;
END;

$$ LANGUAGE plpgsql;
