#Cupparis Packages uninstallation file
#####

#cup-cont-start
php8.0 artisan uninstall-cupparis-package CupCont
php8.0 artisan migrate:rollback --path=Modules/CupCont/Database/Migrations/main
#cup-cont-end

#cup-anag-start
php8.0 artisan uninstall-cupparis-package CupAnag
php8.0 artisan migrate:rollback --path=Modules/CupAnag/Database/Migrations/main
#cup-anag-end

#cup-geo-start
#rm public/admin/assets/css/flag-icon.css
#rm public/admin/assets/flags

php8.0 artisan uninstall-cupparis-package CupGeo
php8.0 artisan migrate:rollback --path=Modules/CupGeo/Database/Migrations/datafile
php8.0 artisan migrate:rollback --path=Modules/CupGeo/Database/Migrations/main
#cup-geo-end
