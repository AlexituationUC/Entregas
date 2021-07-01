CREATE OR REPLACE FUNCTION

realizar_compra (id_usr int, id_prod int, id_tienda int, id_dir int)

RETURNS varchar(100) AS $$

DECLARE
id_compra_max int;

BEGIN

    IF id_prod not in (SELECT Productos.id FROM Productos, Tiendas, tienen WHERE Tiendas.id = id_tienda AND Productos.id = tienen.id_productos AND Tiendas.id = tienen.id_tiendas) THEN
        RETURN "Producto no disponible en esta tienda"
    END IF;

    IF id_usr not in (Usuarios.id FROM Usuarios, pide_a, Direcciones, esta_en, Comunas, reparten_a, Tiendas WHERE Tiendas.id = id_tienda AND Tiendas.id = reparten_a.id_tiendas AND Comunas.id = reparten_a.id_comunas AND Comunas.id = esta_en.id_comunas AND Direcciones.id = esta_en.id_direcciones AND Direcciones.id = pide_a.id_direcciones AND Usuarios.id = pide_a.id_usuarios AND Usuarios.id = id_usr) THEN
        RETURN "Tienda no reparte a su comuna"
    END IF;

    SELECT INTO id_compra_max
    MAX(id)
    FROM Compras;
    
    INSERT INTO Compras VALUES(id_compra_max + 1, id_usr, id_dir, id_tienda);
    INSERT INTO carritos VALUES(id_compra_max + 1, id_prod);
    RETURN "Compra exitosa"


END
$$ language plpgsql