<?php

    $function = $_POST['function'];
    
    function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    $m = new Memcached();

    /* Add 2 servers, so that the second one
    is twice as likely to be selected. */
    $m->addServer('localhost:3000', 11211, 33);
    $m->addServer('localhost:3001', 11211, 67);

    $token = bin2hex(openssl_random_pseudo_bytes(16));

    echo $stoken;

?>