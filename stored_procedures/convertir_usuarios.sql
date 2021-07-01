CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
convertir_usuarios ()

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos la idmax de los usurios y de las direcciones
DECLARE
p record;
idmax_usuarios int;
idmax_direcciones int;

-- definimos nuestra función
BEGIN

    -- obtenemos el personal de administracion
    FOR p in SELECT p.rut as rut, p.nombre as nombre, p.edad as edad, d.nombre_direccion as direccion
             FROM Personal as p, Administrativos as a, Unidades as u, Direcciones as d
             WHERE p.id = a.id AND a.id_unidades = u.id AND u.id_direcciones = d.id
    -- los registramos como usuarios
    LOOP
        -- si el personal ya se encuentra registrado como usuari entonces no se
        -- vuelve a registrar, de esta formo evitamos duplicados
        IF p.rut not in (SELECT rut FROM Usuarios) THEN
            -- guardamos la maxima id de los usuarios registrados en la BD
            SELECT INTO idmax_usuarios
            MAX(id)
            FROM Usuarios;

            -- actualizamos las tablas con la informacion nueva
            insert into Usuarios values(idmax_usuarios + 1, p.rut);
            insert into info_Usuarios values(p.rut, p.nombre, p.edad);

            -- actualizamos la relacion de usuarios con direcciones, asumimos que, como se
            -- indico en las issues, no se ingresaran direcciones que no se encuentren previamente
            -- en las bases de datos
            FOR d in SELECT id, direccion FROM Direcciones
            LOOP
                IF p.direccion = d.direccion THEN
                    insert into pide_a values(idmax_usuarios + 1, d.id);
                END IF;

            END LOOP;
        END IF;
    END LOOP;

RETURN TRUE

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql