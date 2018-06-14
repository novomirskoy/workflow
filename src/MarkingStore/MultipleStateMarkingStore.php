<?php

namespace Novomirskoy\Workflow\MarkingStore;

use Assert\Assertion;
use Novomirskoy\Workflow\Marking;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * MultipleStateMarkingStore stores the marking into a property of the subject.
 *
 * This store deals with a "multiple state" Marking. It means a subject can be
 * in many states at the same time.
 *
 * Class MultipleStateMarkingStore
 * @package Novomirskoy\Workflow\MarkingStore
 */
final class MultipleStateMarkingStore implements MarkingStoreInterface
{
    /**
     * @var string
     */
    private $property;

    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * MultipleStateMarkingStore constructor.
     *
     * @param string $property
     * @param PropertyAccessorInterface|null $propertyAccessor
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($property = 'marking', PropertyAccessorInterface $propertyAccessor = null)
    {
        Assertion::string($property);

        $this->property = $property;
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * @inheritDoc
     */
    public function getMarking($subject)
    {
        return new Marking($this->propertyAccessor->getValue($subject, $this->property) ?: []);
    }

    /**
     * @inheritDoc
     */
    public function setMarking($subject, Marking $marking)
    {
        $this->propertyAccessor->setValue($subject, $this->property, $marking->getPlaces());
    }

}
