<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AccordionItem extends Component
{
    private $withBs;
    private $parentId; // Fill this for always open accordion
    private $isOpen;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($withBs = false, $parentId = null, $isOpen = false)
    {
        $this->withBs = $withBs;
        $this->parentId = $parentId;
        $this->isOpen = $isOpen;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.accordion-item', [
            'withBs' => $this->withBs,
            'parentId' => $this->parentId,
            'isOpen' => $this->isOpen,
        ]);
    }
}
