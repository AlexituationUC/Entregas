CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
convertir_usuarios (rut varchar(255), nombre varchar(255), edad int, direccion varchar(255))

-- declaramos que la funcion no retorna nada
RETURNS void AS $$

-- declaramos la id maxima de los usuarios
DECLARE
idmax_usuarios int;
d record;

-- definimos nuestra función
BEGIN

    -- si el personal ya se encuentra registrado como usuari entonces no se
    -- vuelve a registrar, de esta formo evitamos duplicados
    IF EXISTS (SELECT u.rut FROM Usuarios as u WHERE u.rut = rut) THEN
        -- guardamos la maxima id de los usuarios registrados en la BD
        SELECT INTO idmax_usuarios
        MAX(id)
        FROM Usuarios;

        -- actualizamos las tablas con la informacion nueva
        insert into Usuarios values(idmax_usuarios + 1, rut);
        -- la contraseña correspondera a los 4 primeros digitos del rut
        insert into info_Usuarios values(rut, nombre, edad, SUBSTRING(rut, 1, 4));

        -- actualizamos la relacion de usuarios con direcciones, asumimos que, como se
        -- indico en las issues, no se ingresaran direcciones que no se encuentren registradas
        -- en las bases de datos
        FOR d in SELECT id, direccion FROM Direcciones
        LOOP
            IF direccion = d.direccion THEN
                insert into pide_a values(idmax_usuarios + 1, d.id);
            END IF;

        END LOOP;
    END IF;

END
$$ language plpgsql