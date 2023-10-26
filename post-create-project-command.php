<?php
require_once "./vendor/autoload.php";

echo <<<EOF

\033[32mProyecto creado con exito!\033[37m

Ejecuta los siguientes comandas:

$ cd [path-project]

\033[33mRecuerda!\033[37m
Configura tus accesos de la base de datos en: '.env'.

EOF;

replaceInFile('.env', 'sophy-framework', basename(__DIR__));

unlink('post-create-project-command.php');
