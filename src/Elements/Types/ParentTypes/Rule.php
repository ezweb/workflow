<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Rule extends ParentType
{
    /**
     * @var mixed
     */
    private $return;

    public static function getName(): string
    {
        return 'rule';
    }

    public function getResult(array $vars): bool
    {
        $result = true;
        foreach ($this->values as $value) {
            // is result still valid ?
            $result = $result === $value->getResult($vars);
        }
        return $result;
    }

    public static function loadFromConfig(\stdClass $config): ParentType
    {
        $instance = new static();
        $instance->return = $config->return;
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => self::getName(),
            'return' => $this->return,
            'value' => $this->values
        ];
    }

    public function __toString(): string
    {
        return implode(', ', array_map(
            function ($v) {
                return '(' . $v . ') -> ' . $this->return;
            },
            $this->values
        ));
    }
}
