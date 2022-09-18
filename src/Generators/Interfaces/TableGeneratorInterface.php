<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Generators\Interfaces;

use Tall\Migration\Definitions\TableDefinition;

interface TableGeneratorInterface
{
    public static function driver(): string;

    public function shouldResolveStructure(): bool;

    public function resolveStructure();

    public function parse();

    public function cleanUp();

    public function definition(): TableDefinition;
}
