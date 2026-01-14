#!/usr/bin/env php
<?php

/**
 * Script per applicare manualmente la patch onelogin/php-saml
 * per aggiungere AttributeConsumingServiceIndex all'AuthnRequest
 */

$filePath = __DIR__ . '/../vendor/onelogin/php-saml/src/Saml2/AuthnRequest.php';

if (!file_exists($filePath)) {
    echo "Errore: File non trovato: $filePath\n";
    exit(1);
}

$content = file_get_contents($filePath);

// Verifica se la patch è già applicata
if (strpos($content, 'AttributeConsumingServiceIndex') !== false) {
    echo "La patch è già applicata!\n";
    exit(0);
}

// Trova la sezione da modificare
$searchOld = <<<'SEARCH'
        }

        $spEntityId = htmlspecialchars($spData['entityId'], ENT_QUOTES);
        $acsUrl = htmlspecialchars($spData['assertionConsumerService']['url'], ENT_QUOTES);
        $destination = $this->_settings->getIdPSSOUrl();
        $request = <<<AUTHNREQUEST
<samlp:AuthnRequest
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    ID="$id"
    Version="2.0"
{$providerNameStr}{$forceAuthnStr}{$isPassiveStr}
    IssueInstant="{$issueInstant}"
SEARCH;

$replaceNew = <<<'REPLACE'
        }

        // Add AttributeConsumingServiceIndex if attributeConsumingService is configured
        $attributeConsumingServiceIndexStr = '';
        if (isset($spData['attributeConsumingService'])) {
            // Check if index is explicitly set, otherwise use 1 as default (matching Metadata.php)
            $acsIndex = isset($spData['attributeConsumingService']['index'])
                ? $spData['attributeConsumingService']['index']
                : 1;
            $attributeConsumingServiceIndexStr = <<<ACSINDEX

    AttributeConsumingServiceIndex="$acsIndex"
ACSINDEX;
        }

        $spEntityId = htmlspecialchars($spData['entityId'], ENT_QUOTES);
        $acsUrl = htmlspecialchars($spData['assertionConsumerService']['url'], ENT_QUOTES);
        $destination = $this->_settings->getIdPSSOUrl();
        $request = <<<AUTHNREQUEST
<samlp:AuthnRequest
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    ID="$id"
    Version="2.0"
{$providerNameStr}{$forceAuthnStr}{$isPassiveStr}{$attributeConsumingServiceIndexStr}
    IssueInstant="{$issueInstant}"
REPLACE;

$contentNew = str_replace($searchOld, $replaceNew, $content);

if ($contentNew === $content) {
    echo "Errore: Non è stato possibile applicare la patch. Il file potrebbe essere già modificato o la versione del pacchetto è diversa.\n";
    exit(1);
}

if (file_put_contents($filePath, $contentNew) === false) {
    echo "Errore: Non è stato possibile scrivere il file.\n";
    exit(1);
}

echo "✓ Patch applicata con successo!\n";
echo "File modificato: $filePath\n";
exit(0);
