<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1\Traits;

use BackedEnum;
use CanisLupus\ApiClients\PagSeguro\v1\PagSeguroApiCommon;
use DateTimeInterface;
use ReflectionClass;

trait Arrayable
{
    private function extractValue($value)
    {
        if (is_a($value, DateTimeInterface::class)) {
            $value = $value->format(DateTimeInterface::ATOM);
        } else if (is_object($value)) {
            if ($value instanceof BackedEnum) {
                $value = $value->value;
            } else if (method_exists($value, 'toArray')) {
                $value = $value->toArray();
            } else {
                $value = [];
            }
        } else if (is_array($value)) {
            $values = [];
            foreach ($value as $v) {
                $values[] = $this->extractValue($v);
            }
            $value = $values;
        }

        return $value;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $reflectionClass = new ReflectionClass(get_class($this));
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $key = PagSeguroApiCommon::camelCaseToSnakeCase($property->getName());
            $value = $this->extractValue($property->getValue($this));

            if (!$value) {
                continue;
            }

            $array[$key] = $value;
        }

        return $array;
    }
}
