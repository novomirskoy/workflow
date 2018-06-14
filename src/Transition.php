<?php

namespace Novomirskoy\Workflow;

use Assert\Assertion;

final class Transition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $froms;

    /**
     * @var array
     */
    private $tos;

    /**
     * Transition constructor.
     * @param string $name
     * @param string|string[] $froms
     * @param string|string[] $tos
     */
    public function __construct($name, $froms, $tos)
    {
        Assertion::string($name);

        $this->name = $name;
        $this->froms = (array)$froms;
        $this->tos = (array)$tos;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getFroms()
    {
        return $this->froms;
    }

    /**
     * @return array
     */
    public function getTos()
    {
        return $this->tos;
    }
}
