<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'tb_department';

    protected $primaryKey = 'id_department';
}
