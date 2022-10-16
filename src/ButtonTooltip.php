<?php

namespace Batch\ButtonTooltip;

use Laravel\Nova\Fields\Field;

class ButtonTooltip extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'button-tooltips';

    public $showOnCreation = false;
    public $showOnUpdate = false;

    public function buttons($buttons)
    {
        return $this->withMeta(['buttons' => $buttons]);
    }
}
