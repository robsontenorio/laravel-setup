<?php
 
namespace App;
 
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model as BaseModel;
 
class Model extends BaseModel
{
    protected $rules = [];
    protected $messages = [];
 
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
 
    protected static function boot()
    {
        parent::boot();
 
        static::saving(function ($model) {
            $model->validate();
        });
    }
    public function validate()
    {
        Validator::make($this->toArray(), $this->rules, $this->messages)->validate();
    }
 
    public function toJson($options = 0)
    {
         
        return json_encode($this->toArray(), JSON_NUMERIC_CHECK);
    }
}
