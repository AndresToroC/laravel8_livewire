<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserLivewire extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => ''], 'paginate' => ['except' => '5']];
    public $search = '';
    public $paginate = '5';

    // List users
    public function render()
    {
        $users = User::where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->paginate($this->paginate);

        return view('livewire.user-livewire', [
            'users' => $users
        ]);
    }

    // Edit user
    public function edit(User $user) {
        
    }

    public function clear() {
        $this->search = '';
        $this->paginate = '5';
        $this->page = '1';
    }
}
