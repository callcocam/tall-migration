<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Generators\Concerns;

use Tall\Migration\Generators\BaseTableGenerator;

/**
 * Trait CleansUpColumnIndices
 * @package Tall\Migration\Generators\Concerns
 * @mixin BaseTableGenerator
 */
trait CleansUpColumnIndices
{
    protected function cleanUpColumnsWithIndices(): void
    {
        foreach ($this->definition()->getIndexDefinitions() as &$index) {
            /** @var \Tall\Migration\Definitions\IndexDefinition $index */
            if (! $index->isWritable()) {
                continue;
            }
            $columns = $index->getIndexColumns();

            foreach ($columns as $indexColumn) {
                foreach ($this->definition()->getColumnDefinitions() as $column) {
                    if ($column->getColumnName() === $indexColumn) {
                        $indexType = $index->getIndexType();
                        $isMultiColumnIndex = $index->isMultiColumnIndex();

                        if ($indexType === 'primary' && ! $isMultiColumnIndex) {
                            $column->setPrimary(true)->addIndexDefinition($index);
                            $index->markAsWritable(false);
                        } elseif ($indexType === 'index' && ! $isMultiColumnIndex) {
                            $isForeignKeyIndex = false;
                            foreach ($this->definition()->getIndexDefinitions() as $innerIndex) {
                                if ($innerIndex->getIndexType() === 'foreign' && ! $innerIndex->isMultiColumnIndex() && $innerIndex->getIndexColumns()[0] == $column->getColumnName()) {
                                    $isForeignKeyIndex = true;

                                    break;
                                }
                            }
                            if ($isForeignKeyIndex === false) {
                                $column->setIndex(true)->addIndexDefinition($index);
                            }
                            $index->markAsWritable(false);
                        } elseif ($indexType === 'unique' && ! $isMultiColumnIndex) {
                            $column->setUnique(true)->addIndexDefinition($index);
                            $index->markAsWritable(false);
                        }
                    }
                }
            }
        }
    }
}
