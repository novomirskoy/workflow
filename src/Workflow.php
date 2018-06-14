<?php

namespace Novomirskoy\Workflow;

use Assert\Assertion;
use Novomirskoy\Workflow\Exception\LogicException;
use Novomirskoy\Workflow\MarkingStore\MarkingStoreInterface;
use Novomirskoy\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Workflow implements WorkflowInterface
{
    /**
     * @var Definition
     */
    private $definition;

    /**
     * @var MarkingStoreInterface
     */
    private $markingStore;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var string
     */
    private $name;

    /**
     * Workflow constructor.
     *
     * @param Definition $definition
     * @param MarkingStoreInterface|null $markingStore
     * @param EventDispatcherInterface|null $dispatcher
     * @param string $name
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        Definition $definition,
        MarkingStoreInterface $markingStore = null,
        EventDispatcherInterface $dispatcher = null,
        $name = 'unnamed'
    ) {
        Assertion::string($name);

        $this->definition = $definition;
        $this->markingStore = $markingStore ?: new MultipleStateMarkingStore();
        $this->dispatcher = $dispatcher;
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getMarking($subject)
    {
        $marking = $this->markingStore->getMarking($subject);

        if (!$marking instanceof Marking) {
            throw new LogicException(sprintf(
                'The value returned by MarkingStore is not an instance of "%s" for workflow "%s".',
                'Novomirskoy\Workflow\Marking',
                $this->name
            ));
        }

        return $marking;
    }

    /**
     * @inheritDoc
     */
    public function can($subject, $transitionName)
    {
        // TODO: Implement can() method.
    }

    /**
     * @inheritDoc
     */
    public function apply($subject, $transitionName)
    {
        // TODO: Implement apply() method.
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }

    /**
     * @inheritDoc
     */
    public function getDefinition()
    {
        // TODO: Implement getDefinition() method.
    }

    /**
     * @inheritDoc
     */
    public function getMarkingStore()
    {
        // TODO: Implement getMarkingStore() method.
    }
}
