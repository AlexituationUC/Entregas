CREATE OR REPLACE FUNCTION
tres_mas_baratos(tipo varchar)
RETURNS TABLE(
			   nombre varchar,
			   precio integer,
			   descripcion varchar
			   ) AS $$
BEGIN
IF tipo == "comestible" THEN 
	RETURN (
	SELECT nombre, precio, descripcion
	FROM Productos, Comestibles
	WHERE Productos.id = Comestibles.id
	ORDER BY precio
	LIMIT 3);
ELSE
RETURN (
	SELECT nombre, precio, descripcion
	FROM Productos, No_Comestibles
	WHERE Productos.id = No_Comestibles.id
	ORDER BY precio
	LIMIT 3)
END IF;
END;

$$ LANGUAGE plpgsql;
