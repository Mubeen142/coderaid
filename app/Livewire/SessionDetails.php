<?php

namespace App\Livewire;

use Livewire\Component;

class SessionDetails extends Component
{
    public $nickname = 'User1';

    public $server = '';

    public $location = '';

    public $session;

    public function mount($session)
    {
        $this->session = $session;
    }

    public function updateSession()
    {
        if($this->session->users()->count() == 0) {
            $this->session->update([
                'server' => $this->server,
                'location' => $this->location,
            ]);
            
            $this->session->users()->create([
                'nickname' => $this->nickname,
                'ip_address' => request()->ip(),
                'current_code_id' => 1,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.session-details');
    }
}
