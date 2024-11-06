#Cupparis Packages installation file
#####

#cup-geo-start
php8.0 artisan vendor:publish --provider="Modules\CupGeo\Providers\CupGeoServiceProvider"
php8.0 /usr/local/bin/composer dump-autoload
php8.0 artisan install-cupparis-package CupGeo
php8.0 artisan module:migrate CupGeo --subpath=main
php8.0 artisan module:migrate CupGeo --subpath=datafile
php8.0 artisan module:seed CupGeo
#ln -s ../../../../vendor/components/flag-icon-css/css/flag-icon.css public/admin/assets/css/flag-icon.css
#ln -s ../../../vendor/components/flag-icon-css/flags public/admin/assets/flags
#cup-geo-end

#cup-anag-start
php8.0 artisan vendor:publish --provider="Modules\CupAnag\Providers\CupAnagServiceProvider"
php8.0 /usr/local/bin/composer dump-autoload
php8.0 artisan install-cupparis-package CupAnag
php8.0 artisan module:migrate CupAnag --subpath=main
php8.0 artisan module:seed CupAnag
#cup-anag-end

#cup-cont-start
php8.0 artisan vendor:publish --provider="Modules\CupCont\Providers\CupContServiceProvider"
php8.0 /usr/local/bin/composer dump-autoload
php8.0 artisan install-cupparis-package CupCont
php8.0 artisan module:migrate CupCont --subpath=main
php8.0 artisan module:seed CupCont
#cup-cont-end


#cup-site-start
#php8.0 artisan vendor:publish --provider="Modules\CupSite\Providers\CupSiteServiceProvider"
#composer dump-autoload
#php8.0 artisan install-cupparis-package CupSite
#php8.0 artisan module:migrate CupSite --subpath=main
#php8.0 artisan module:seed CupSite
#cup-site-end


#cup-chart-start
#php8.0 artisan vendor:publish --provider="Modules\CupChart\Providers\CupChartServiceProvider"
#php8.0 artisan install-cupparis-package CupChart
#php8.0 artisan module:migrate CupChart --subpath=main
#php8.0 artisan module:seed CupChart
#cup-chart-end
