<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\GeneratorManagers\Interfaces;

use Tall\Migration\Definitions\ViewDefinition;
use Tall\Migration\Definitions\TableDefinition;

interface GeneratorManagerInterface
{
    public static function driver(): string;

    public function handle(string $basePath, array $tableNames = [], array $viewNames = []);

    public function addTableDefinition(TableDefinition $definition);

    public function addViewDefinition(ViewDefinition $definition);

    public function getTableDefinitions(): array;

    public function getViewDefinitions(): array;
}
