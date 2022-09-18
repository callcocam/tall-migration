<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Generators\Concerns;

use Tall\Migration\Generators\BaseTableGenerator;

/**
 * Trait CleansUpForeignKeyIndices
 * @package Tall\Migration\Generators\Concerns
 * @mixin BaseTableGenerator
 */
trait CleansUpForeignKeyIndices
{
    protected function cleanUpForeignKeyIndices(): void
    {
        $indexDefinitions = $this->definition()->getIndexDefinitions();
        foreach ($indexDefinitions as $index) {
            /** @var \Tall\Migration\Definitions\IndexDefinition $index */
            if ($index->getIndexType() === 'index') {
                //look for corresponding foreign key for this index
                $columns = $index->getIndexColumns();
                $indexName = $index->getIndexName();

                foreach ($indexDefinitions as $innerIndex) {
                    /** @var \Tall\Migration\Definitions\IndexDefinition $innerIndex */
                    if ($innerIndex->getIndexName() !== $indexName) {
                        if ($innerIndex->getIndexType() === 'foreign') {
                            $cols = $innerIndex->getIndexColumns();
                            if (count(array_intersect($columns, $cols)) === count($columns)) {
                                //has same columns
                                $index->markAsWritable(false);

                                break;
                            }
                        }
                    }
                }
            }
        }
    }
}
