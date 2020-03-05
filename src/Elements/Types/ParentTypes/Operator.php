<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Operator extends ParentType
{
    private \Ezweb\Workflow\Elements\Operators\Operator $operator;

    public static function getName(): string
    {
        return 'operator';
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new self();
        $operatorClass = self::$operatorProvider->getClass($config->operator);
        $instance->operator = new $operatorClass();
        return $instance;
    }

    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): ParentType
    {
        parent::addValue($value);
        $this->operator->addOperand($value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getResult(array $vars)
    {
        return $this->operator->getResult($vars);
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => self::getName(),
            'operator' => $this->operator::getName(),
            'value' => $this->values
        ];
    }
}