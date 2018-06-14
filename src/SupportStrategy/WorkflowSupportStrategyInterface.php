<?php

namespace Novomirskoy\Workflow\SupportStrategy;

use Novomirskoy\Workflow\WorkflowInterface;

interface WorkflowSupportStrategyInterface
{
    /**
     * @param WorkflowInterface $workflow
     * @param object $subject
     *
     * @return bool
     */
    public function supports(WorkflowInterface $workflow, $subject);
}
