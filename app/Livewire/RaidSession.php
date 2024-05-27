<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class RaidSession extends Component
{
    public $nickname = 'User1';

    public $server = '';

    public $location = '';

    public $session_password = '';

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
                'session_password' => $this->session_password ? Hash::make($this->session_password) : null,
            ]);
            
            $user = $this->session->users()->create([
                'nickname' => $this->nickname,
                'ip_address' => request()->ip(),
                'current_code_id' => 1,
            ]);

            Cookie::queue($this->session->token, $user->id, 60 * 24 * 30);

            // reload the page to get the new cookie
            $this->redirect(route('session.view', $this->session->token), navigate: true);
        }
    }

    public function addUser()
    {
        if($this->session->session_password && !Hash::check($this->session_password, $this->session->session_password)) {
            return abort(403, 'Invalid session password');
        }

        if($this->session->users()->count() >= 20) {
            return abort(403, 'Session is full');
        }

        $user = $this->session->users()->create([
            'nickname' => $this->nickname,
            'ip_address' => request()->ip(),
            'current_code_id' => min(10000, $this->session->getHighestCode()->id + 1),
        ]);

        Cookie::queue($this->session->token, $user->id, 60 * 24 * 30);

        $this->redirect(route('session.view', $this->session->token), navigate: true);
    }

    public function nextCode()
    {
        if($this->session->master_code_id) {
            return;
        }

        if(!$this->session->started_at) {
            $this->session->update([
                'started_at' => now(),
            ]);
        }

        if(!$this->user->started_at) {
            $this->user->update([
                'started_at' => now(),
            ]);
        }
        
        $this->user->increment('total_guess_count');
        $this->user->update([
            'current_code_id' => min(10000, $this->session->getHighestCode()->id + 1),
        ]);
    }

    public function previousCode()
    {
        if($this->session->master_code_id) {
            return;
        }

        // check if guess count is greater than 0
        if($this->user->total_guess_count > 0) {
            $this->user->decrement('total_guess_count');
        }

        $this->user->update([
            'current_code_id' => max(1, $this->session->getHighestCode()->id - 1)
        ]);
    }

    public function triggerCodeFound()
    {
        if(!$this->session->master_code_id) {
            $this->session->update([
                'master_code_id' => $this->user->current_code_id,
            ]);
        }
    }

    public function triggerContinueSession()
    {
        if($this->session->master_code_id) {
            $this->session->update([
                'master_code_id' => null,
            ]);
        }

        $this->session->users()->update([
            'confetti' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.raid-session');
    }
}
