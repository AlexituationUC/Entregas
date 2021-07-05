CREATE OR REPLACE FUNCTION

-- declaramos la función
asignar_contrasenas ()

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos la idmax de los usurios y de las direcciones
DECLARE
usuario record;

-- definimos nuestra función
BEGIN

    -- verificar si existe la columna clave, si no existe la agregamos y seteamos todos los
    -- valores como un espacio
    IF 'clave' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='info_Usuarios') THEN
        ALTER TABLE info_Usuarios ADD clave varchar(255);
        -- UPDATE info_Usuarios SET clave = " ";
    END IF;

    -- asignamos las claves a los usuarios por medio de un loop
    FOR usuario in SELECT rut, clave FROM info_Usuarios
    LOOP
        -- las contraseñas corresponden a los primeros 4 digitos del rut
        UPDATE info_usuarios
        SET clave = SUBSTRING(usuario.rut, 1, 4)
        WHERE rut = usuario.rut;
    END LOOP;

    -- se retorna un TRUE para señalar que ya se asignaron las contraseñas
    RETURN TRUE;

END
$$ language plpgsql