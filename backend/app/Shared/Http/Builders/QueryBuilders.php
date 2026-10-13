<?php

namespace App\Shared\Http\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryBuilders
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @return Builder $builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = Str::snake($field);
            if (is_array($value)) {
                call_user_func_array([$this, $method], [$value]);
            } else {
                call_user_func_array([$this, $method], (array)$value);
            }
        }

        return $builder;
    }

    /**
     * @return array
     */
    abstract protected function fields(): array;
}
