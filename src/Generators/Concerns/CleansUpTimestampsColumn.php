<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Generators\Concerns;

use Tall\Migration\Generators\BaseTableGenerator;

/**
 * Trait CleansUpTimestampsColumn
 * @package Tall\Migration\Generators\Concerns
 * @mixin BaseTableGenerator
 */
trait CleansUpTimestampsColumn
{
    protected function cleanUpTimestampsColumn(): void
    {
        $timestampColumns = [];
        foreach ($this->definition()->getColumnDefinitions() as &$column) {
            $columnName = $column->getColumnName();
            if ($columnName === 'created_at') {
                $timestampColumns['created_at'] = $column;
            } elseif ($columnName === 'updated_at') {
                $timestampColumns['updated_at'] = $column;
            }
            if (count($timestampColumns) === 2) {
                foreach ($timestampColumns as $timestampColumn) {
                    if ($timestampColumn->useCurrent() || $timestampColumn->useCurrentOnUpdate()) {
                        //don't convert to a `timestamps()` method if useCurrent is used

                        return;
                    }
                }
                $timestampColumns['created_at']
                    ->setColumnName(null)
                    ->setMethodName('timestamps')
                    ->setNullable(false);
                $timestampColumns['updated_at']->markAsWritable(false);

                break;
            }
        }
    }
}
