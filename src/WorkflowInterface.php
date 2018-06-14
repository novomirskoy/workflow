<?php

namespace Novomirskoy\Workflow;

use Novomirskoy\Workflow\MarkingStore\MarkingStoreInterface;

interface WorkflowInterface
{
    /**
     * Returns the object's Marking.
     *
     * @param object $subject A subject
     *
     * @return Marking The Marking
     */
    public function getMarking($subject);

    /**
     * Returns true if the transition is enabled.
     *
     * @param object $subject A subject
     * @param string $transitionName A transition
     *
     * @return bool true if the transition is enabled
     */
    public function can($subject, $transitionName);

    /**
     * Fire a transition.
     *
     * @param object $subject
     * @param string $transitionName
     *
     * @return mixed
     */
    public function apply($subject, $transitionName);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return Definition
     */
    public function getDefinition();

    /**
     * @return MarkingStoreInterface
     */
    public function getMarkingStore();
}
