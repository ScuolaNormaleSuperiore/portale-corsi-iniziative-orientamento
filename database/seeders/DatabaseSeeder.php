<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(RegioniProvinceTableSeeder::class);
        $this->call(MaterieSettoriTableSeeder::class);
        $this->call(TitoliProfessioniLivelliTableSeeder::class);
        $this->call(ClassiOrientamentoTableSeeder::class);
        $this->call(SezioniLayoutTableSeeder::class);

        $this->call(IniziativeTableSeeder::class);

//        INSERT INTO `saml2_tenants` (`id`, `uuid`, `key`, `idp_entity_id`, `idp_login_url`, `idp_logout_url`, `idp_x509_cert`, `metadata`, `created_at`, `updated_at`, `deleted_at`, `relay_state_url`, `name_id_format`)
//VALUES
//(1, 'bf441d43-662c-4c96-9451-b7c8a51c21a1', 'cineca-pp', 'https://sns.idp.pp.cineca.it/idp/shibboleth', 'https://sns.idp.pp.cineca.it/idp/profile/SAML2/POST/SSO', 'https://sns.idp.pp.cineca.it/idp/profile/SAML2/POST/SLO', 'MIIDETCCAfmgAwIBAgIJALLKQ3t0bIMyMA0GCSqGSIb3DQEBCwUAMB8xHTAbBgNVBAMMFHNucy5pZHAucHAuY2luZWNhLml0MB4XDTIxMDIwMjIxNTAyNloXDTQxMDIwMTIxNTAyNlowHzEdMBsGA1UEAwwUc25zLmlkcC5wcC5jaW5lY2EuaXQwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDCMudNo0DmS24eUu7WmvSBsaCiiaPwXIjZhZsqHDYckyF', X'5B5D', '2024-12-19 15:31:21', '2024-12-19 15:31:21', NULL, NULL, 'persistent');

    }
}
