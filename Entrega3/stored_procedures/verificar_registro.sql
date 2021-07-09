CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_rut (nombre varchar(255), rut varchar(255), edad int, direccion varchar)

-- declaramos que retorna un booleano
RETURNS BOOLEAN AS $$

-- declaramos la idmax de los usurios
DECLARE
idmax_usuarios int;
d record;


-- define la funcion
BEGIN

    -- si el rut ya esta registrado en la BD retorna FALSE

    IF rut IN (SELECT Usuarios.rut FROM Usuarios) THEN
        RETURN FALSE;

    END IF;

    -- guardamos la maxima id de los usuarios registrados en la BD
    SELECT INTO idmax_usuarios
    MAX(id)
    FROM Usuarios;

    -- actualizamos las tablas con la informacion nueva
    insert into Usuarios values(idmax_usuarios + 1, rut);
    insert into info_Usuarios values(rut, nombre, edad);

    -- actualizamos la relacion de usuarios con direcciones, asumimos que, como se
    -- indico en las issues, no se ingresaran direcciones que no se encuentren previamente
    -- en las bases de datos
    FOR d in SELECT Direcciones.id, Direcciones.direccion FROM Direcciones
    LOOP
        IF direccion = d.direccion THEN
            insert into pide_a values(idmax_usuarios + 1, d.id);
        END IF;

    END LOOP;

    -- si se logro registrar correctamente, se retorna true.
    RETURN TRUE;

END
$$ language plpgsql