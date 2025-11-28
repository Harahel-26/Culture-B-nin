#!/bin/bash

if [ -z "$1" ]; then
  echo "Usage: ./generate-crud.sh NomDuModule"
  exit 1
fi

NAME=$1
LOWER=$(echo "$NAME" | tr '[:upper:]' '[:lower:]')

# Génère le modèle, migration et controller resource dans Admin
php artisan make:model $NAME -m
php artisan make:controller Admin/${NAME}Controller --resource --model=$NAME

# Génère un seeder et une factory
php artisan make:seeder ${NAME}Seeder
php artisan make:factory ${NAME}Factory --model=$NAME

# Crée le dossier des vues Blade (exemple: admin/products)
VIEW_DIR="resources/views/admin/${LOWER}s"
mkdir -p $VIEW_DIR

# Génère les fichiers Blade
touch $VIEW_DIR/index.blade.php
touch $VIEW_DIR/create.blade.php
touch $VIEW_DIR/edit.blade.php
touch $VIEW_DIR/show.blade.php
touch $VIEW_DIR/form.blade.php

echo "CRUD pour $NAME généré avec succès !"
echo "Controller créé dans app/Http/Controllers/Admin/${NAME}Controller.php"
echo "Vues Blade créées dans $VIEW_DIR"
