if [ -z "$1" ];
then
  echo "Inserire la cartella da sincronizzare (path assoluto)"
  echo "--dry-run per verificare i files da aggiornare senza aggiornare"
else
  #echo "$1 ($2)"
  if [ -z "$2" ];
  then
    read -p "sincronizzo con la cartella $1? Y/n" risp
    if [ "$risp" = "Y" ];
    then
       #rsync -atzv --no-o --no-g  --exclude-from=./resources/scripts/excludersync.txt --delete  . $1
       rsync -atzv --no-o --no-g  --exclude-from=./resources/scripts/excludersync.txt  . $1
       echo "rsync terminato"
    fi
  else
    if [ "$2" = "--dry-run" ];
    then
      echo "modalità dry-run"
      rsync -natzv --no-o --no-g  --exclude-from=./resources/scripts/excludersync.txt  . $1
    else
      echo "$2 parametro non riconosciuto!"
      exit
    fi


  fi
fi
