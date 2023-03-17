<?php
function slug(string $input): string {

    $replacebles = [
        '_',
        '-',
        ' '
    ];

    foreach ($replacebles as $replaceble) {
        $offset = 0;

        while (($offset = strpos($input, $replaceble, $offset)) !== false) {
            $input = substr_replace($input,'',$offset,1);
            if(isset($input[$offset])) {
                $input[$offset] = strtoupper($input[$offset]);
            }
        }
    }

    return $input;
}

$input = '                   The quick-brown_fox jumps over the_lazy-dog        ';

echo slug($input);