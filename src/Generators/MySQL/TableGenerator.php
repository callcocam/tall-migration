<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Generators\MySQL;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Tall\Migration\Generators\BaseTableGenerator;
use Tall\Migration\Tokenizers\MySQL\IndexTokenizer;
use Tall\Migration\Tokenizers\MySQL\ColumnTokenizer;

/**
 * Class TableGenerator
 * @package Tall\Migration\Generators\MySQL
 */
class TableGenerator extends BaseTableGenerator
{
    public static function driver(): string
    {
        return 'mysql';
    }

    public function resolveStructure()
    {
        $structure = DB::select('SHOW CREATE TABLE `' . $this->definition()->getTableName() . '`');
        $structure = $structure[0];
        $structure = (array) $structure;
        if (isset($structure['Create Table'])) {
            $lines = explode("\n", $structure['Create Table']);

            array_shift($lines); //get rid of first line
            array_pop($lines); //get rid of last line

            $lines = array_map(fn ($item) => trim($item), $lines);
            $this->rows = $lines;
        } else {
            $this->rows = [];
        }
    }

    protected function isColumnLine($line)
    {
        return ! Str::startsWith($line, ['KEY', 'PRIMARY', 'UNIQUE', 'FULLTEXT', 'CONSTRAINT']);
    }

    public function parse()
    {
        foreach ($this->rows as $line) {
            if ($this->isColumnLine($line)) {
                $tokenizer = ColumnTokenizer::parse($line);
                $this->definition()->addColumnDefinition($tokenizer->definition());
            } else {
                $tokenizer = IndexTokenizer::parse($line);
                $this->definition()->addIndexDefinition($tokenizer->definition());
            }
        }
    }
}
