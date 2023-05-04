<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Users extends Component
{
    use LivewireAlert;

    use WithPagination;

    public $selectedId;

    // Controles de búsqueda
    public $perPage, $keyWord;

    // Atributos del modelo
    public $clave, $password, $password_confirmation;

    // Ordenamiento
    public $order, $field;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy'];

    public function render()
    {
        $keyWord = '%'.$this->keyWord.'%';

        // Recuperar los registros del modelo
        $users = User::clave($keyWord);

        if( isset($this->field) && isset($this->order) ){
            $users->orderBy($this->field, $this->order);
        } else {
            $users->orderByDesc('created_at');
        }

        $users = $users->paginate($this->perPage);

        return view('livewire.users', [
            'users' => $users
        ])
        ->layout(\App\View\Components\AppLayout::class, [
            'title' => 'Usuarios',
            // 'layout' => '',
            'isFluid' => false,
            'isComponent' => true
        ]);
    }

    public function mount()
    {
        // Inicializar controles de búsqueda
        $this->keyWord = "";
        $this->perPage = 10;

        // Sorting
        $this->order = null;
        $this->field = null;

        // Clear fields
        $this->cancel();
    }

    public function updatingKeyWord()
    {
        $this->resetPage();
    }

    public function sortable($field)
    {
        if($this->field !== $field){
            $this->order = null;
        }
        switch ($this->order) {
            case null:
                $this->order = 'asc';
                break;
            case 'asc':
                $this->order = 'desc';
                break;
            case 'desc':
                $this->order = null;
                break;
        }
        $this->field = $field;
    }

    public function store()
    {
        $this->validate([
            'clave' => 'required|string|max:30',
            'password' => 'required|string|min:6|confirmed'
        ]);

        try {
            $user = User::create([
                'clave' => $this->clave,
                'password' => \Illuminate\Support\Facades\Hash::make($this->password)
            ]);

            // Limpiar todos los campos
            $this->emit('cerrarModal', 'modal-create-user');

            /**
             * Limpiar el campo de búsqueda para cargar todos los resultados
             * En primer lugar posicionar el recién agregado
             */
            $this->keyWord = '';

            $this->alert('success', '¡Usuario agregado!', [
                'position' =>  'center',
                // 'text' => '...',
                'timer' =>  1500,
                'toast' =>  false
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', '¡Algo salió mal!', [
                'position' =>  'center',
                'timer' => '',
                'toast' =>  false,
                'text' => $th->getMessage(),
                'showCancelButton' =>  true
            ]);
        }
    }

    /**
     *
     * @param object
     * @return void
     */
    public function edit(User $object)
    {
        $this->selectedId = $object->id;
        $this->clave = $object->clave;
    }

    public function update()
    {
        $this->validate([
            'clave' => 'required|string|max:30|unique:users,clave,'.$this->selectedId
        ]);

        try {
            $record = User::findOrFail($this->selectedId);

            $record->update([
                'clave' => $this->clave,
            ]);

            $this->emit('cerrarModal', 'modal-edit-user');

            $this->alert('success', '¡Usuario actualizado!', [
                'position' =>  'center',
                // 'text' => '...',
                'timer' =>  1500,
                'toast' =>  false
            ]);

        } catch (\Throwable $th) {
            $this->alert('error', '¡Algo salió mal!', [
                'position' =>  'center',
                'timer' => '',
                'toast' =>  false,
                'text' => $th->getMessage(),
                'showCancelButton' =>  true
            ]);
        }
    }

    /**
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $this->selectedId = $id;

        try {
            // Recuperar el nombre del usuario para mostrar detalle en la alerta
            $user = User::find($this->selectedId);

            $this->confirm('¿Quieres eliminar a '.$user->clave.'?', [
                // 'text' => '',
                'confirmButtonText' =>  'Eliminar',
                'cancelButtonText' => 'Cancelar',
                'onConfirmed' => [
                    'component' => 'users',
                    'listener' => 'destroy'
                ]
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', '¡Algo salió mal!', [
                'position' =>  'center',
                'toast' =>  false,
                'timer' => '',
                'text' => $th->getMessage(),
                'showCancelButton' =>  true
            ]);
        }
    }

    public function destroy()
    {
        try {
            User::destroy($this->selectedId);

            $this->cancel();

            $this->alert('success', '¡El usuario se ha eliminado!', [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'showCancelButton' =>  false
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', '¡Algo salió mal!', [
                'position' =>  'center',
                'toast' =>  false,
                'text' => $th->getMessage(),
                'showCancelButton' =>  true
            ]);
        }
    }

    public function cancel()
    {
        $this->reset('selectedId', 'clave', 'password', 'password_confirmation');

        $this->resetErrorBag();
    }
}
