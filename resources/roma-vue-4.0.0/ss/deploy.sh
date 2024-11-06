LARAVELDIR="$PWD/../../../"
CRUD_DIR="$PWD/../src/crud/"
TRANSLATIONSDIR="resources/roma-vue-4.0.0/src/crud"
BASE_CRUD_DIR="resources/roma-vue-4.0.0/src/crud"
PHP_BIN=${PHP_BIN:="php"}
if [ -z "$1" ]
then
      echo "publish application"
      cd ..
      sh publish.sh
else
      #echo "\$1 command"
      case $1 in
         translate)
            echo "translate"
            cd $LARAVELDIR
            $PHP_BIN artisan translations
            mv public/js/*-translations.json $TRANSLATIONSDIR
            ;;
         templates)
            echo "generating template"
            cd ../
            sass --update public/layout:public/layout
            sass --update public/theme:public/theme
            ;;
         icons)
            echo "generating icons file"
            cd $LARAVELDIR
            $PHP_BIN artisan icons --path=$BASE_CRUD_DIR
            ;;
#         pattern3)
#            Statement(s) to be executed if pattern3 matches
#            ;;
         *)
           echo "($1) non trovato"
           ;;
      esac
fi


