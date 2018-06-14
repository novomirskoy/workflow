<?php

namespace Novomirskoy\Workflow\Event;

use Assert\Assertion;
use Novomirskoy\Workflow\Marking;
use Novomirskoy\Workflow\Transition;
use Novomirskoy\Workflow\WorkflowInterface;
use Symfony\Component\EventDispatcher\Event as BaseEvent;

class Event extends BaseEvent
{
    /**
     * @var object
     */
    private $subject;

    /**
     * @var Marking
     */
    private $marking;

    /**
     * @var Transition
     */
    private $transition;

    /**
     * @var WorkflowInterface
     */
    private $workflow;

    /**
     * Event constructor.
     * @param $subject
     * @param Marking $marking
     * @param Transition $transition
     * @param WorkflowInterface $workflow
     */
    public function __construct($subject, Marking $marking, Transition $transition, WorkflowInterface $workflow)
    {
        Assertion::isObject($subject);

        $this->subject = $subject;
        $this->marking = $marking;
        $this->transition = $transition;
        $this->workflow = $workflow;
    }

    /**
     * @return object
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return Marking
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * @return Transition
     */
    public function getTransition()
    {
        return $this->transition;
    }

    /**
     * @return WorkflowInterface
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }
}
