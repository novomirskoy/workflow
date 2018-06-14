<?php

namespace Novomirskoy\Workflow;

use Assert\Assertion;
use Novomirskoy\Workflow\Exception\LogicException;

final class Definition
{
    /**
     * @var array
     */
    private $places = [];

    /**
     * @var Transition[]
     */
    private $transitions = [];

    /**
     * @var string
     */
    private $initialPlace;

    /**
     * Definition constructor.
     * @param string[] $places
     * @param Transition[] $transitions
     * @param string|null $initialPlace
     */
    public function __construct(
        array $places,
        array $transitions,
        $initialPlace = null
    ) {
        foreach ($places as $place) {
            $this->addPlace($place);
        }

        foreach ($transitions as $transition) {
            $this->addTransition($transition);
        }

        $this->setInitialPlace($initialPlace);
    }

    /**
     * @return string
     */
    public function getInitialPlace()
    {
        return $this->initialPlace;
    }

    /**
     * @return string[]
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * @return Transition[]
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

    /**
     * @param string $place
     *
     * @return void
     */
    private function addPlace($place)
    {
        Assertion::string($place);

        if (0 === count($this->places)) {
            $this->initialPlace = $place;
        }

        $this->places[$place] = $place;
    }

    /**
     * @param Transition $transition
     *
     * @return void
     *
     * @throws LogicException
     */
    private function addTransition(Transition $transition)
    {
        $name = $transition->getName();

        foreach ($transition->getFroms() as $from) {
            if (!array_key_exists($from, $this->places)) {
                throw new LogicException(sprintf('Place "%s" referenced in transition "%s" does not exist.', $from, $name));
            }
        }

        foreach ($transition->getTos() as $to) {
            if (!array_key_exists($to, $this->places)) {
                throw new LogicException(sprintf('Place "%s" referenced in transition "%s" does not exist.', $to, $name));
            }
        }

        $this->transitions[] = $transition;
    }

    /**
     * @param string|null $place
     *
     * @return void
     *
     * @throws LogicException
     */
    private function setInitialPlace($place = null)
    {
        if (null === $place) {
            return;
        }

        if (!array_key_exists($place, $this->places)) {
            throw new LogicException(sprintf('Place "%s" cannot be the initial place as it does not exist.', $place));
        }

        $this->initialPlace = $place;
    }
}
