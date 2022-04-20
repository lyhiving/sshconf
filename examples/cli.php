<?php
include __DIR__ . '/../autoload.php';

use lyhiving\sshconf\sshconf;

define('IA_ROOT', dirname(__DIR__));

$sshconf = new sshconf(__DIR__ . "/#remotessh.txt");
var_dump($sshconf->gets());

// $container = $sshconf->get();
// $container->rewind();
// while ($container->valid()) {
//     $line = $container->current();
//     if (gettype($line) != 'object') {
//         $container->next();
//         continue;
//     };
//     if (strpos(get_class($line), 'sshhost') === false) {
//         $container->next();
//         continue;
//     };
//     var_dump($line->__toString());
//     var_dump(get_class($line));
//     var_dump(strpos(get_class($line), 'sshhost'));
//     var_dump($line);
//     var_dump($line->__toString());
//     var_dump($line->name());
//     var_dump($line->name('HostName'));
//     var_dump($line->name('User'));
//     var_dump($line->name('Port'));
//     var_dump($line->name('IdentityFile'));
//     exit;
//     // var_dump($line->__toString());
//     // if ($line->comment()) {
//     //   if ($line && $line->key('Host')) {
//     //     var_dump($line->key());
//     //     exit;
//     //     // var_dump($container->current());
//     //   }
//     // }
//     // exit;
//     $container->next();
// }
