<?php
require_once "./vendor/autoload.php";

echo <<<EOF

\033[32mProyecto creado con exito!\033[37m

Ejecuta los siguientes comandas:

$ cd [path-project]

\033[33mRecuerda!\033[37m
Configura tus accesos de la base de datos en: '.env'.

EOF;
$basenameDir = basename(__DIR__);

$content = <<<EOF
APP_NAME=Sophy
APP_URL=localhost
APP_ENV=dev
APP_DOMAIN='http://localhost/$basenameDir'
PATH_ROUTE='/$basenameDir'

TIME_ZONE=America/Lima

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=

JWT_SECRET_KEY=sophy
EOF;

$fp = fopen($_SERVER['DOCUMENT_ROOT'] . ".env","wb");
fwrite($fp,$content);
fclose($fp);

unlink('post-create-project-command.php');
