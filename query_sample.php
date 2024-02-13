<?php

$bin_addr = sprintf('\\x%s', bin2hex(inet_pton('214.0.0.0')));
$dbh      = new PDO('pgsql:host=localhost;port=5432', 'postgres', 'password');

$prep = $dbh->prepare(
    "SELECT *
FROM 
 (
SELECT *
FROM geolite2_network
WHERE :ip_addr >= network_start
ORDER BY network_start DESC
LIMIT 1
) net
WHERE :ip_addr <= network_end;"
);
$prep->bindValue(':ip_addr', $bin_addr, PDO::PARAM_LOB);
$prep->execute();
var_dump($prep->fetchAll());
