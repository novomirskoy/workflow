<?php

namespace Novomirskoy\Workflow\MarkingStore;

use Assert\Assertion;
use Novomirskoy\Workflow\Marking;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * SingleStateMarkingStore stores the marking into a property of the subject.
 *
 * This stores deals with a "single state" Marking. It means a subject can be in
 * one and only one state at the same time.
 *
 * Class SingleStateMarkingStore
 * @package Novomirskoy\Workflow\MarkingStore
 */
final class SingleStateMarkingStore implements MarkingStoreInterface
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
     * SingleStateMarkingStore constructor.
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
     * @inheritdoc
     */
    public function getMarking($subject)
    {
        $placeName = $this->propertyAccessor->getValue($subject, $this->property);

        if (!$placeName) {
            return new Marking();
        }

        return new Marking([$placeName => 1]);
    }

    /**
     * @inheritdoc
     */
    public function setMarking($subject, Marking $marking)
    {
        $this->propertyAccessor->setValue($subject, $this->property, key($marking->getPlaces()));
    }
}
