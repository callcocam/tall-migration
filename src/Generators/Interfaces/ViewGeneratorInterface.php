<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Generators\Interfaces;

interface ViewGeneratorInterface
{
    public static function driver(): string;

    public function parse();

    public function resolveSchema();
}
