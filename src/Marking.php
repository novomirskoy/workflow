<?php

namespace Novomirskoy\Workflow;

final class Marking
{
    private $places = [];

    /**
     * Marking constructor.
     * @param int[] $representation Keys are the place name and values should be 1
     */
    public function __construct(array $representation = [])
    {
        foreach ($representation as $place => $nbToken) {
            $this->mark($place);
        }
    }

    /**
     * @param string $place
     *
     * @return void
     */
    public function mark($place)
    {
        $this->places[$place] = 1;
    }

    /**
     * @param string $place
     *
     * @return void
     */
    public function unmark($place)
    {
        unset($this->places[$place]);
    }

    /**
     * @param string $place
     *
     * @return bool
     */
    public function has($place)
    {
        return array_key_exists($place, $this->places);
    }

    /**
     * @return array
     */
    public function getPlaces()
    {
        return $this->places;
    }
}
