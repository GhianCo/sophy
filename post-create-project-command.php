<?php

echo <<<EOF

\033[32mProyecto creado con exito!\033[37m

Ejecuta los siguientes comandas:

$ cd [path-project]

\033[33mRecuerda!\033[37m
Configura tus accesos de la base de datos en: '.env'.

EOF;

function replace_file($path, $string, $replace)
{
    set_time_limit(0);

    if (is_file($path) === true)
    {
        $file = fopen($path, 'r');
        $temp = tempnam('./', 'tmp');

        if (is_resource($file) === true)
        {
            while (feof($file) === false)
            {
                file_put_contents($temp, str_replace($string, $replace, fgets($file)), FILE_APPEND);
            }

            fclose($file);
        }

        unlink($path);
    }

    return rename($temp, $path);
}

replace_file('.env', 'sophy-framework', 'pepe');

unlink('post-create-project-command.php');
