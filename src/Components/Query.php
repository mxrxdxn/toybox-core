<?php

namespace Toybox\Core\Components;

use Query\Builder;

class Query extends \Query\Query
{
    /**
     * Allow override of the "setup" method with a hook.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function setup(Builder $builder): Builder
    {
        do_action("toybox_query_setup", $builder);

        return $builder;
    }
}
