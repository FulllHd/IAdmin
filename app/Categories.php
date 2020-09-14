<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use ModelTree, AdminBuilder;

    public $timestamps = false;

    protected $table = 'categories';
    protected $attributes = [
        'image' => '',
        'ord' => 0,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('ord');
        $this->setTitleColumn('titleuk');
    }
}
