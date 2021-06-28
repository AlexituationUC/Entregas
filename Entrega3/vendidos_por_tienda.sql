CREATE OR REPLACE FUNCTION
vendidos_por_tienda(tienda integer, producto varchar)
RETURNS TABLE(
			   nombre varchar,
			   precio integer,
			   descripcion varchar
			   ) AS $$
BEGIN
RETURN (
	SELECT Productos.id, Productos.nombre, descripcion, Productos.precio
	FROM Productos, Tiendas, Compras, carritos
	WHERE Productos.id = carritos.id_productos 
	AND Tiendas.id = Compras.id_tienda
	AND Compras.id = carritos.id_compras
	AND LOWER(Productos.nombre) LIKE LOWER(FORMAT('%s%', producto))
	AND Tiendas.id = tienda
	);
END;

$$ LANGUAGE plpgsql;
