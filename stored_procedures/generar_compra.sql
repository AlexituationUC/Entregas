CREATE OR REPLACE FUNCTION
generar_compra(tienda integer, producto integer, usuario integer)
RETURNS varchar AS $$

-- La idea es pasarle los id's de cada cosa

DECLARE
id_max int;
id_direccion int;

BEGIN

SELECT * 
FROM Tiendas, Productos, tienen
WHERE Tiendas.id = tienen.id_tiendas
AND Productos.id = tienen.id_productos
AND Productos.id = producto

IF NOT FOUND THEN
	RETURN("Producto no disponible en la tienda");
END IF;

-- La función retorna si no encuentra el producto en la tienda

SELECT *
FROM Usuarios, pide_a, Direcciones as d, esta_en, Comunas, reparten_a, Tiendas
WHERE Usuarios.id = pide_a.id_usuarios AND d.id = pide_a.id_direcciones
AND d.id = esta_en.id_direcciones AND Comunas.id = esta_en.id_comunas
AND Tiendas.id = reparten_a.id_tiendas AND reparten_a.id_comunas = Comunas.id
AND Usuarios.id = usuario AND Tiendas.id = tienda

IF NOT FOUND THEN
	RETURN("La compra no puede proceder (la tienda no reparte a su comuna)");
END IF;

-- La función retorna si no encuentra la comuna del usuario en las comunas a las que la tienda reparte

SELECT INTO id_max
MAX(id)
FROM Compras

SELECT INTO id_direccion
Direcciones.id
FROM Direcciones, Usuarios, pide_a
WHERE Direcciones.id = pide_a.id_direcciones AND Usuarios.id = pide_a.id_usuarios
AND Usuarios.id = usuario

INSERT INTO Compras(id_max + 1, id_direccion, tienda, usuario)
INSERT INTO carritos(id_max + 1, producto)

RETURN("Compra exitosa :D");

END;

$$ LANGUAGE plpgsql;
