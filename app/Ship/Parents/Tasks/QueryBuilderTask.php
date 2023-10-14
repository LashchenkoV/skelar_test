<?php

namespace App\Ship\Parents\Tasks;


use Illuminate\Contracts\Database\Eloquent\Builder;

abstract class QueryBuilderTask extends Task
{
    protected array $differences = [];

    protected Builder $query;

    public function __construct()
    {
        $this->query = $this->buildBaseQuery();
    }

    public function run(array $parameters): Builder
    {
        $this->handleParameters($parameters);

        return $this->query;
    }

    abstract protected function buildBaseQuery(): Builder;

    protected function handleParameters(array $parameters): void
    {
        foreach ($parameters as $name => $value) {
            if ($value === null) {
                continue;
            }

            $customFunctionName = $this->differences[$name] ?? null;
            $methodName = $customFunctionName ?? 'handle' . ucfirst($name);

            if (method_exists(static::class, $methodName)) {
                $this->{$methodName}($value);
            }
        }
    }
}
