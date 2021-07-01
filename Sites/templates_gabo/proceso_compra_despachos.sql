CREATE OR REPLACE FUNCTION

realizar_compra (id_usr int, id_dir int)

RETURNS void AS $$

DECLARE
id_compra_max int;

BEGIN

    SELECT INTO id_compra_max
    MAX(id)
    FROM Compras;
    
    INSERT INTO Compras VALUES(id_compra_max + 1, id_usr, id_dir);

END
$$ language plpgsql