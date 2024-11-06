
- dalla root del progetto eseguire  "sh scripts/storage.sh" 
- composer update
- php artisan storage:link
- dalla directory storage/app eseguire  ln -s ../files files
- copiare il file .env.example come .env
- modificare il contenuto .env generato secondo le proprie esigenze (cambire in particolare il database e app_url)
- importare il db in database/dumps
- eseguire il comando php artisan init e rispondere "y" alle domande
