Importing GeoIP2 or GeoLite2 databases to PostgreSQL without cidr type

1,
Use this.
https://github.com/maxmind/geoip2-csv-converter

$ ./geoip2-csv-converter -block-file GeoIP2-City-Blocks-IPv4.csv -include-hex-range -output-file GeoIP2-City-Blocks-IPv4-Hex.csv
$ ./geoip2-csv-converter -block-file GeoIP2-City-Blocks-IPv6.csv -include-hex-range -output-file GeoIP2-City-Blocks-IPv6-Hex.csv

2,
Escape hex for import into PostgreSQL
$ php geoip2-csv-converter.php

3,
Import it
\copy geoip2_network from 'GeoIP2-City-Blocks-IPv4-Hex_escaped.csv' with (format csv, header);
\copy geoip2_network from 'GeoIP2-City-Blocks-IPv6-Hex_escaped.csv' with (format csv, header);


Reference
https://dev.maxmind.com/geoip/importing-databases
