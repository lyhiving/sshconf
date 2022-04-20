<?php

namespace lyhiving\sshconf;

class sshhost
{
    /** @var string[] $lines */
    private $lines;
    /** @var string $key */
    private $name;
    /** @var boolean $comment */
    private $comment;

    public function __construct(sshline $line)
    {
        $this->attach($line);
        $this->name = $line->value();
        $this->comment = $line->comment();
    }

    public function attach(sshline $line)
    {
        $this->lines[] = $line;
    }

    public function name(string $name = null)
    {
        if ($name === null) {
            return $this->name;
        } else {
            if(!$this->lines){
                return false;;
            }
            foreach($this->lines as $line){
                if (!$line)
                    continue;
                if($line->key()==$name){
                    return $line->value();
                }
            }
            return false;
        }
    }

    public function lines(){
        return $this->lines;
    }
 

    public function host(){
        return $this->name('Host');
    }


    public function hostname(){
        return $this->name('HostName');
    }

    public function user(){
        return $this->name('User');
    }

    public function password(){
        return $this->name('Password');
    }

    public function port(){
        return $this->name('Port');
    }


    public function identityfile(){
        return $this->name('IdentityFile');
    }

    public function __toString(): string
    {
        return implode('', $this->lines);
    }
}
