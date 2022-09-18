<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Helpers;

trait WritableTrait
{
    public bool $writable = true;

    public function markAsWritable(bool $writable = true)
    {
        $this->writable = $writable;

        return $this;
    }

    public function isWritable()
    {
        return $this->writable;
    }
}
