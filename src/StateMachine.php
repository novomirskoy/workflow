<?php

namespace Novomirskoy\Workflow;

use Novomirskoy\Workflow\Exception\LogicException;
use Novomirskoy\Workflow\MarkingStore\MarkingStoreInterface;
use Novomirskoy\Workflow\MarkingStore\SingleStateMarkingStore;

final class StateMachine implements WorkflowInterface
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
     * @var string
     */
    private $name;

    /**
     * StateMachine constructor.
     * @param Definition $definition
     * @param MarkingStoreInterface|null $markingStore
     * @param string $name
     */
    public function __construct(
        Definition $definition,
        MarkingStoreInterface $markingStore = null,
        $name = 'unnamed'
    ) {
        $this->definition = $definition;
        $this->markingStore = $markingStore ?: new SingleStateMarkingStore();
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getMarking($subject)
    {
        $marking = $this->markingStore->getMarking($subject);

        if (!$marking instanceof Marking) {
            throw new LogicException(sprintf(
                'The value returned by the MarkingStore is not an instance of "%s" for workflow "%s".',
                'Novomirskoy\Workflow\Marking',
                $this->name
            ));
        }

        return $marking;
    }

    /**
     * @inheritdoc
     */
    public function can($subject, $transitionName)
    {
        $transitions = $this->definition->getTransitions();
    }

    /**
     * @inheritdoc
     */
    public function apply($subject, $transitionName)
    {

    }

    /**
     * @inheritdoc
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @inheritdoc
     */
    public function getMarkingStore()
    {
        return $this->markingStore;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }
}
