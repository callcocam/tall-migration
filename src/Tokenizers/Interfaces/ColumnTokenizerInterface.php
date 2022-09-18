<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Migration\Tokenizers\Interfaces;

use Tall\Migration\Definitions\ColumnDefinition;

interface ColumnTokenizerInterface
{
    public function tokenize(): self;

    public function definition(): ColumnDefinition;
}
