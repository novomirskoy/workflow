<?php

namespace Novomirskoy\Workflow\MarkingStore;

use Novomirskoy\Workflow\Marking;

interface MarkingStoreInterface
{
    /**
     * @param object $subject
     *
     * @return Marking
     */
    public function getMarking($subject);

    /**
     * @param object $subject
     * @param Marking $marking
     *
     * @return void
     */
    public function setMarking($subject, Marking $marking);
}
