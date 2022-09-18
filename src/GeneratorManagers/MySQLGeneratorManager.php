<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\GeneratorManagers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Tall\Migration\Definitions\TableDefinition;
use Tall\Migration\Generators\MySQL\ViewGenerator;
use Tall\Migration\Generators\MySQL\TableGenerator;
use Tall\Migration\GeneratorManagers\Interfaces\GeneratorManagerInterface;

class MySQLGeneratorManager extends BaseGeneratorManager implements GeneratorManagerInterface
{
    public static function driver(): string
    {
        return 'mysql';
    }

    public function init()
    {
        $tables = DB::select('SHOW FULL TABLES');

        foreach ($tables as $rowNumber => $table) {
            $tableData = (array) $table;
            $table = $tableData[array_key_first($tableData)];
            $tableType = $tableData['Table_type'];
            if ($tableType === 'BASE TABLE') {
                $this->addTableDefinition(TableGenerator::init($table)->definition());
            } elseif ($tableType === 'VIEW') {
                $this->addViewDefinition(ViewGenerator::init($table)->definition());
            }
        }
    }

    public function addTableDefinition(TableDefinition $tableDefinition): BaseGeneratorManager
    {
        $prefix = config('database.connections.' . DB::getDefaultConnection() . '.prefix', '');
        if (! empty($prefix) && Str::startsWith($tableDefinition->getTableName(), $prefix)) {
            $tableDefinition->setTableName(Str::replaceFirst($prefix, '', $tableDefinition->getTableName()));
        }

        return parent::addTableDefinition($tableDefinition);
    }
}
