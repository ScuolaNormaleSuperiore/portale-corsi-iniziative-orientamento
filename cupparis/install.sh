#Cupparis Packages installation file
#####

#cup-geo-start
php artisan vendor:publish --provider="Modules\CupGeo\Providers\CupGeoServiceProvider"
composer dump-autoload
php artisan install-cupparis-package CupGeo
php artisan module:migrate CupGeo --subpath=main
php artisan module:migrate CupGeo --subpath=datafile
php artisan module:seed CupGeo
#ln -s ../../../../vendor/components/flag-icon-css/css/flag-icon.css public/admin/assets/css/flag-icon.css
#ln -s ../../../vendor/components/flag-icon-css/flags public/admin/assets/flags
#cup-geo-end

#cup-anag-start
php artisan vendor:publish --provider="Modules\CupAnag\Providers\CupAnagServiceProvider"
composer dump-autoload
php artisan install-cupparis-package CupAnag
php artisan module:migrate CupAnag --subpath=main
php artisan module:seed CupAnag
#cup-anag-end

#cup-cont-start
php artisan vendor:publish --provider="Modules\CupCont\Providers\CupContServiceProvider"
composer dump-autoload
php artisan install-cupparis-package CupCont
php artisan module:migrate CupCont --subpath=main
php artisan module:seed CupCont
#cup-cont-end


#cup-site-start
#php artisan vendor:publish --provider="Modules\CupSite\Providers\CupSiteServiceProvider"
#composer dump-autoload
#php artisan install-cupparis-package CupSite
#php artisan module:migrate CupSite --subpath=main
#php artisan module:seed CupSite
#cup-site-end


#cup-chart-start
#php artisan vendor:publish --provider="Modules\CupChart\Providers\CupChartServiceProvider"
#php artisan install-cupparis-package CupChart
#php artisan module:migrate CupChart --subpath=main
#php artisan module:seed CupChart
#cup-chart-end
