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

Se dopo un `composer update` la patch viene persa, puoi riapplicarla con:

```bash
cd /path/to/project
patch -p0 < patches/onelogin-php-saml-add-attribute-consuming-service-index.patch
```

Oppure modificare manualmente il file `vendor/onelogin/php-saml/src/Saml2/AuthnRequest.php` seguendo le indicazioni nella patch.

### Automazione con composer-patches

Per applicare automaticamente la patch dopo ogni `composer install/update`, installa il pacchetto `cweagans/composer-patches`:

```bash
composer require cweagans/composer-patches
```

E aggiungi in `composer.json`:

```json
{
    "extra": {
        "patches": {
            "onelogin/php-saml": {
                "Add AttributeConsumingServiceIndex to AuthnRequest": "patches/onelogin-php-saml-add-attribute-consuming-service-index.patch"
            }
        }
    }
}
```

### Verifica

Dopo aver applicato la patch, puoi verificare che l'`AttributeConsumingServiceIndex` sia presente nella richiesta SAML controllando il XML della AuthnRequest. Dovrebbe contenere:

```xml
<samlp:AuthnRequest
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    AttributeConsumingServiceIndex="1"
    ...>
```
