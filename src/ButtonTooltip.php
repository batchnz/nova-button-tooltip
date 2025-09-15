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
    public $component = 'button-tooltip';

    public $showOnCreation = false;
    public $showOnUpdate = false;

    public function buttons($buttons)
    {
      return $this->withMeta(['buttons' => $buttons]);
    }

    public function modalConfig($config)
    {
      return $this->withMeta(['modalConfig' => $config]);
    }
}
