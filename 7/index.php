<?php
function isValidUrl(string $input): string
{
    $pattern = '/https?:\/\/(?<subdomain>[A-Za-z0-9_\-~]+\.)?(?<domain>[A-Za-z0-9_\-~]+\.)(?<topDomain>\w{1,63}?$)/';
    return preg_match($pattern, $input) === 1 ? 'OK' : 'NOT OK';
}

$cases = [
    'https://innovice.comdddd',
    'http://innovice.com',
    'http://local.inno-vice.com',
    'htp://innovice.com'
];

foreach ($cases as $case) {
    echo isValidUrl($case) . '<br/>';
}

