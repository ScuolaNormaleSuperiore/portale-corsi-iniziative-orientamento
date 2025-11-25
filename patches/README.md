# Patches

Questa directory contiene le patch applicate ai pacchetti vendor.

## onelogin-php-saml-add-attribute-consuming-service-index.patch

**Pacchetto:** `onelogin/php-saml`
**File modificato:** `vendor/onelogin/php-saml/src/Saml2/AuthnRequest.php`

### Problema

Il modulo OneLogin PHP-SAML supporta la definizione di `attributeConsumingService` con `requestedAttributes` nei metadata del Service Provider, ma **non include** l'attributo `AttributeConsumingServiceIndex` nelle richieste SAML AuthnRequest inviate all'Identity Provider.

Senza questo attributo, l'IdP non sa quale set di attributi richiesti utilizzare, anche se sono correttamente definiti nel metadata SP.

### Soluzione

La patch modifica il file `AuthnRequest.php` per:

1. Verificare se `attributeConsumingService` è configurato nella sezione `sp` del config
2. Se presente, aggiungere l'attributo `AttributeConsumingServiceIndex` alla richiesta SAML
3. Utilizzare l'indice specificato in `attributeConsumingService.index`, oppure `1` come default (matching con quanto fatto in `Metadata.php`)

### Configurazione richiesta

Nel file `config/saml2.php`, assicurati di avere configurato:

```php
'sp' => [
    // ... altre configurazioni

    "attributeConsumingService" => [
        "serviceName" => "Service Name", // opzionale
        "serviceDescription" => "Service Description", // opzionale
        "index" => 1, // opzionale, default 1
        "requestedAttributes" => [
            [
                "name" => "spidName",
                "isRequired" => false,
                "friendlyName" => "spidName",
            ],
            [
                "name" => "spidEmail",
                "isRequired" => false,
                "friendlyName" => "spidEmail",
            ],
            // ... altri attributi
        ],
    ],
],
```

### Come applicare manualmente la patch

La patch viene applicata automaticamente dopo ogni `composer install` e `composer update` tramite lo script `patches/apply-patch.php` configurato in `composer.json`.

Se per qualche motivo la patch non viene applicata automaticamente, puoi eseguire manualmente:

```bash
# Con DDEV
ddev exec php patches/apply-patch.php

# Senza DDEV
php patches/apply-patch.php
```

Lo script verifica se la patch è già applicata e la applica solo se necessario.

### Configurazione automatica

Lo script è già configurato in `composer.json` nella sezione `scripts`:

```json
{
    "scripts": {
        "post-install-cmd": [
            "@php patches/apply-patch.php"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force",
            "@php patches/apply-patch.php"
        ]
    }
}
```

Questo garantisce che la patch venga applicata automaticamente dopo ogni `composer install` o `composer update`.

### Verifica

Dopo aver applicato la patch, puoi verificare che l'`AttributeConsumingServiceIndex` sia presente nella richiesta SAML controllando il XML della AuthnRequest. Dovrebbe contenere:

```xml
<samlp:AuthnRequest
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    AttributeConsumingServiceIndex="1"
    ...>
```
