<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ProjectModel extends Model
{
    /**
     * Create a new Eloquent model instance with current project config
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->perPage = Config::get('project.default_objects_per_page');
    }
}
