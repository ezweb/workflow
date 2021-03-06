<?php
namespace Ezweb\Workflow\Elements\Actions;


abstract class Action extends \Ezweb\Workflow\Elements\Element
{
    /**
     * @var \Ezweb\Workflow\Elements\Types\Type[]
     */
    protected array $args = [];

    /**
     * @param \Ezweb\Workflow\Elements\Types\Type $arg
     * @return static
     */
    public function addArgs(\Ezweb\Workflow\Elements\Types\Type $arg): self
    {
        $this->args[] = $arg;
        return $this;
    }

    public static function create(): self
    {
        return new static();
    }

    /**
     * @return \Ezweb\Workflow\Elements\Types\Type[]
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    final public function getJSONData(): ?array
    {
        return null;
    }

    public function getHash(): string
    {
        return $this->hash($this->getArgs());
    }
}
