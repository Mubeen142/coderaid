<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class RaidSession extends Component
{
    public $nickname = 'User1';

    public $server = '';

    public $location = '';

    public $session;

    public $user;

    public function mount($session)
    {
        $this->session = $session;
        $this->user = $session->users()->find(Cookie::get($session->token));
    }

    public function updateSession()
    {
        if($this->session->users()->count() == 0) {
            $this->session->update([
                'server' => $this->server,
                'location' => $this->location,
            ]);
            
            $avatarId = rand(1, 50);
            $user = $this->session->users()->create([
                'nickname' => $this->nickname,
                'avatar' => "assets/img/avatars/AV{$avatarId}.png",
                'ip_address' => request()->ip(),
                'current_code_id' => 1,
            ]);

            Cookie::queue($this->session->token, $user->id, 60 * 24 * 30);

            // reload the page to get the new cookie
            $this->redirect(route('session.view', $this->session->token), navigate: true);
        }
    }

    public function nextCode()
    {
        $this->user->increment('total_guess_count');
        $this->user->update([
            'current_code_id' => min(10000, $this->user->current_code_id + 1),
        ]);
    }

    public function previousCode()
    {
        $this->user->decrement('total_guess_count');
        $this->user->update([
            'current_code_id' => max(1, $this->user->current_code_id - 1)
        ]);
    }

    public function render()
    {
        return view('livewire.raid-session');
    }
}
