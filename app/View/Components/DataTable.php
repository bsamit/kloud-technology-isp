<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $id;
    public $data;

    public function __construct($id = 'basic-9', $data = [])
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function render()
    {
        return view('components.data-table');
    }
}
