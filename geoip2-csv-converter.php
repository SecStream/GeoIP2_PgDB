<?php

$input  = fopen('GeoIP2-City-Blocks-IPv4-Hex.csv', 'r', false);
$output = fopen('GeoIP2-City-Blocks-IPv4-Hex_escaped.csv', 'w', false);

# copy csv header

# read csv
# You may use fgetcsv when reading csv, but not all fields are needed...

# header
[, , $orig] = explode(',', fgets($input), 3);
fwrite($output, sprintf('network_start,network_end,%s', $orig));

while (($line = fgets($input, null)) !== false) {
    [$start_hex, $end_hex, $orig] = explode(',', $line, 3);
    # If you have any good ideas, feel free to send me a pull request.
    fwrite($output, sprintf('\\x%s,\\x%s,%s', bin2hex(pack('H*', $start_hex)), bin2hex(pack('H*', $end_hex)), $orig));
}

$input  = fopen('GeoIP2-City-Blocks-IPv6-Hex.csv', 'r', false);
$output = fopen('GeoIP2-City-Blocks-IPv6-Hex_escaped.csv', 'w', false);

[, , $orig] = explode(',', fgets($input), 3);
fwrite($output, sprintf('network_start,network_end,%s', $orig));

while (($line = fgets($input, null)) !== false) {
    [$start_hex, $end_hex, $orig] = explode(',', $line, 3);
    fwrite($output, sprintf('\\x%s,\\x%s,%s', bin2hex(pack('H*', $start_hex)), bin2hex(pack('H*', $end_hex)), $orig));
}
