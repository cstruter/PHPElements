REM Fetch PHP dependencies and generate autoload information
CALL composer install

REM Fecth JavaScript dependecies
CALL npm install

REM Global dependencies
CALL npm install --global gulp-cli

REM Generate PHP documentation
CALL vendor/bin/phpdoc

REM Generate JavaScript documentation
CALL gulp 

PAUSE