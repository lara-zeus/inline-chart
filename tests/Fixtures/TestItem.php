<?php

namespace LaraZeus\InlineChart\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $category
 * @property int $score
 */
class TestItem extends Model
{
    protected $table = 'test_items';

    protected $guarded = [];
}
