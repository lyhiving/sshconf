<?php

namespace lyhiving\sshconf;

use SplFileObject;
use SplObjectStorage;

class sshconf
{
    /** @var array $config */
    private $config;
    /** @var SplFileObject $file */
    private $file;
    /** @var SplObjectStorage $content */
    private $content;

    public $result;

    public function __construct($filepath)
    {
        $this->content = new SplObjectStorage();
        $this->load($filepath)->parse();
    }

    private function load($filepath): self
    {
        if (!file_exists($filepath)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $filepath));
        }

        $this->file = new SplFileObject($filepath, 'r+');

        return $this;
    }

    public function parse(): self
    {
        /** @var sshhost $host */
        $host = null;
        foreach ($this->file as $line) {
            $line = new sshline($line);
            if ($line->key() === 'Host') {
                $host = new sshhost($line);
                $this->content->attach($host);
            } elseif ($host) {
                $host->attach($line);
            } else {
                $this->content->attach($line);
            }
            while ($this->content->valid()) $this->content->next();
        }
        return $this;
    }

    public function host(string $name): ?sshhost
    {
        foreach ($this->content as $line) {
            if ($line instanceof sshhost) {
                /** @var sshhost $line */
                if ($line->name() === $name) {
                    return $line;
                }
            }
        }
        return null;
    }

    public function gets()
    {
        $container = $this->content;
        if (!$container)
            return false;
        $container->rewind();
        $this->result = [];
        while ($container->valid()) {
            $line = $container->current();
            if (gettype($line) != 'object') {
                $container->next();
                continue;
            };
            if (strpos(get_class($line), 'sshhost') === false) {
                $container->next();
                continue;
            };
            $row = array();
            $row['Host'] = $line->name('Host');
            $row['HostName'] = $line->name('HostName');
            $row['User'] = $line->name('User');
            $row['Port'] = $line->name('Port');
            $row['IdentityFile'] = $line->name('IdentityFile');
            $row['Password'] = $line->name('Password');
            $this->result[] = $row;
            $container->next();
        }
        return $this->result;
    }

    public function get(): SplObjectStorage
    {
        return $this->content;
    }
}
