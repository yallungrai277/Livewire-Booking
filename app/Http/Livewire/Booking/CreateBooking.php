<?php

namespace App\Http\Livewire\Booking;

use App\Models\Service;
use Livewire\Component;

class CreateBooking extends Component
{
    public $employees;

    public $state = [
        'service' => '',
        'employee' => ''
    ];

    public function mount()
    {
        $this->employees = collect();
    }

    public function updatedStateService($serviceId)
    {
        $this->state['employee'] = '';
        if (!$serviceId) {
            $this->employees = collect();
            return;
        }
        $this->employees = $this->selectedService->employees;
    }

    public function getSelectedServiceProperty()  // this automatically registers a $this->selectedService getter
    {
        if (!$this->state['service']) {
            return null;
        }
        return Service::find($this->state['service']);
    }

    public function render()
    {
        $services  = Service::get();
        return view('livewire.booking.create-booking', [
            'services' => $services
        ]);
    }
}