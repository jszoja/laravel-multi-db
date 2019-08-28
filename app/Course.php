<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // this model uses dynamic connection
    protected $connection = DYNAMIC_DB;





}
