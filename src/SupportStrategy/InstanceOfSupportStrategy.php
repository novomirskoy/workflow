<?php

namespace Novomirskoy\Workflow\SupportStrategy;

use Assert\Assertion;
use Novomirskoy\Workflow\WorkflowInterface;

final class InstanceOfSupportStrategy implements WorkflowSupportStrategyInterface
{
    /**
     * @var string
     */
    private $className;

    /**
     * InstanceOfSupportStrategy constructor.
     *
     * @param string $className
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($className)
    {
        Assertion::string($className);

        $this->className = $className;
    }

    /**
     * @inheritDoc
     */
    public function supports(WorkflowInterface $workflow, $subject)
    {
        return $subject instanceof $this->className;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }
}
