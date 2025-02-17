<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LDAP\Result;

class Model extends Eloquent
{
    public static function all($columns = ['*'])
    {
        return static::query()->get($columns);
    }

    public static function find($id, $columns = ['*'])
    {
        return static::query()->find($id, $columns);
    }

    public static function findOrFail($id)
    {
        $record = static::find($id);
        if (!$record) {
            throw new \Exception("No record found");
        }
        return $record;
    }

    public static function create(array $attributes = [])
    {
        $instance = new static($attributes);
        $instance->save();
        return $instance;
    }

    public static function where($column, $operator = null, $value = null)
    {
        return static::query()->where($column, $operator, $value);
    }

    public static function first($columns = ['*'])
    {
        return static::query()->first($columns);
    }

    public static function orderBy($column, $direction = 'asc')
    {
        return static::query()->orderBy($column, $direction);
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        return static::query()->updateOrCreate($attributes, $values);
    }

    public static function testConnection()
    {
        try {
            static::query()->first();
            return ['sucess' => true, 'message' => 'Connection successful'];
        } catch (\Exception $e) {
            return ['sucess' => false, 'message' => $e->getMessage()];
        }
    }
}
