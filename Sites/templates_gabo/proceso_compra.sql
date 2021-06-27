CREATE OR REPLACE FUNCTION

realizar_compra (id_usr int, id_prod int, id_tienda int)

RETURNS varchar(100) AS $$

DECLARE
variable1;
variable2;

BEGIN

    IF id_prod not in (SELECT Productos.id FROM Productos, Tiendas, tienen WHERE Tiendas.id = id_tienda AND Productos.id = tienen.id_productos AND Tiendas.id = tienen.id_tiendas) THEN
        RETURN "Producto no disponible en esta tienda"
    END IF;

    IF id_usr not in (Usuarios.id FROM Usuarios, pide_a, Direcciones, esta_en, Comunas, reparten_a, Tiendas WHERE Tiendas.id = id_tienda AND Tiendas.id = reparten_a.id_tiendas AND Comunas.id = reparten_a.id_comunas AND Comunas.id = esta_en.id_comunas AND Direcciones.id = esta_en.id_direcciones AND Direcciones.id = pide_a.id_direcciones AND Usuarios.id = pide_a.id_usuarios AND Usuarios.id = id_usr) THEN
        RETURN "Tienda no reparte a su comuna"
    END IF;
    
    INSERT INTO XD VALUES();
    RETURN "Compra exitosa"


END
$$ language plpgsql