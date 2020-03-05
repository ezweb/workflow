<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

class Scalar extends ScalarType
{
    /**
     * @var mixed
     */
    public $scalarValue;

    public static function getName(): string
    {
        return 'scalar';
    }

    public function getResult(array $vars)
    {
        return $this->scalarValue;
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => self::getName(),
            'value' => $this->scalarValue
        ];
    }
}