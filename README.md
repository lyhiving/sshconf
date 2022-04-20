## sshconf

Read more about SSH config files: https://linux.die.net/man/5/ssh_config

## Install

Composer

```bash
composer require lyhiving/sshconf
```

```json
{
    "require": {
            "lyhiving/sshconf": "1.*"
    }
}
```

## Useage


```php
<?php 
use lyhiving\sshconf\sshconf;
$sshconf = new sshconf(__DIR__ . "/#remotessh.txt");
var_dump($sshconf->gets());
```

![CLI](https://raw.githubusercontent.com/lyhiving/sshconf/master/examples/image/a.png)

## Notes

Main part from[@m4rku5](https://github.com/M4RKU5-C0D3/sshconf). I had make it  easy to use.