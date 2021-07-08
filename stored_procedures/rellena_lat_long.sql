CREATE OR REPLACE FUNCTION

-- declaramos la función
lat_long_maker (id_dir int, lat real, long real)

-- declaramos lo que retorna 
RETURNS void AS $$

-- definimos nuestra función
BEGIN

    UPDATE Direcciones SET longitude=long, latitude=lat WHERE id=id_dir;

END
$$ language plpgsql