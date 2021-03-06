<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Operator extends ParentType
{
    /**
     * @var \Ezweb\Workflow\Elements\Operators\Operator
     */
    private \Ezweb\Workflow\Elements\Operators\Operator $operator;

    public static function getName(): string
    {
        return 'operator';
    }

    public static function createFromParser(\stdClass $parsedData, \Ezweb\Workflow\Loader $configLoader): self
    {
        $instance = new self();
        $operatorClass = $configLoader->getOperatorProviderConfig()->getClass($parsedData->operator);
        $instance->operator = new $operatorClass();
        return $instance;
    }

    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): ParentType
    {
        $this->operator->addOperand($value);
        return $this;
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return $this->operator->getResult($vars, $childrenValues);
    }

    /**
     * @param \Ezweb\Workflow\Elements\Operators\Operator $operator
     * @return Operator
     */
    public function setOperator(\Ezweb\Workflow\Elements\Operators\Operator $operator): Operator
    {
        $this->operator = $operator;
        return $this;
    }

    public function getJSONData(): ?array
    {
        return [
            'type' => self::getName(),
            'operator' => $this->operator::getName(),
            'value' => $this->operator->getOperands()
        ];
    }

    public function __toString(): string
    {
        return (string) $this->operator;
    }

    public function getValues(): array
    {
        return $this->operator->getOperands();
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        return $this->operator->isValid($vars, $childrenValues);
    }
}
