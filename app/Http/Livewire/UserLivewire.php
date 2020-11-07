<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Session;

class UserLivewire extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => ''], 'paginate' => ['except' => '5']];
    public $search = '';
    public $paginate = '5';

    public $modalUpdate = false;
    public $modalCreate = false;

    public $user_id, $name, $email, $password, $password_confirmation;

    // List users
    public function render()
    {
        $users = User::where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orderBy('id', 'DESC')
            ->paginate($this->paginate);

        return view('livewire.users.index', [
            'users' => $users
        ]);
    }

    // Create user
    public function create() {
        $this->modalCreate = true;
    }

    public function store() {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'email|unique:users|max:255',
            'password' => 'required|confirmed|max:255'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $message = ['color' => 'green', 'text' => 'Usuario agregado correctamente'];
        Session::flash('message', $message);

        $this->modalCreate = false;
        $this->resetInputs();
    }

    // Edit user
    public function edit(User $user) {
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

        $this->modalUpdate = true;
    }

    public function update(User $user) {
        $this->validate([
            'name' => 'required|max:255'
        ]);

        if ($this->password) {
            $this->validate([
                'password' => 'confirmed|max:255'
            ]);
        }

        $user->update([
            'name' => $this->name,
            'password' => Hash::make($this->password)
        ]);

        $message = ['color' => 'green', 'text' => 'Usuario actualizado correctamente'];
        Session::flash('message', $message);

        $this->modalUpdate = false;
        $this->resetInputs();
    }

    public function destroy(User $user) {
        $user->delete();

        $message = ['color' => 'green', 'text' => 'Usuario eliminado correctamente'];
        Session::flash('message', $message);
    }

    public function clear() {
        $this->search = '';
        $this->paginate = '5';
        $this->page = '1';
    }

    public function closeModal() {
        $this->modalCreate = false;
        $this->modalUpdate = false;
    }

    public function resetInputs() {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->password_confirmation = null;
    }
}
