<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Empleados extends Component
{

    use LivewireAlert;

    use WithPagination;

    public $selectedId;

    // Controles de búsqueda
    public $perPage, $keyWord;

    // Atributos del modelo
    public $nombre, $ape_pat, $ape_mat, $fecha_nac, $telefono, $email, $no_empleado, $area, $puesto, $estatus, $fecha_contratacion, $salario;

    // Ordenamiento
    public $order, $field;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['destroy'];

    public function render()
    {
        $keyWord = '%'.$this->keyWord.'%';

        $empleados = Empleado::nombre($keyWord)
            ->email($keyWord)
            ->telefono($keyWord)
            ->puesto($keyWord)
            ->noEmpleado($keyWord);

        if( isset($this->field) && isset($this->order) ){
            $empleados->orderBy($this->field, $this->order);
        } else {
            $empleados->orderByDesc('created_at');
        }

        $empleados = $empleados->paginate($this->perPage);

        // View with records retrieved and set title on Layout based page
        return view('livewire.empleados', [
            'empleados' => $empleados
        ])
        ->layout(\App\View\Components\AppLayout::class, [
            'title' => 'Empleados',
            // 'layout' => '',
            'isFluid' => true,
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

    public function setStatus(Empleado $empleado, bool $estatus)
    {
        try {
            $empleado->update([
                'estatus' => !$estatus
            ]);
            // Success alert
            $this->alert('success', '¡Estatus actualizado!', [
                'position' =>  'center',
                // 'text' => '...',
                'timer' =>  1000,
                'toast' =>  false
            ]);
        } catch (\Throwable $th) {
            // Error alert with exception message
            $this->alert('error', '¡Algo salió mal!', [
                'position' =>  'center',
                'timer' => '',
                'toast' =>  false,
                'text' => $th->getMessage(),
                'showCancelButton' =>  true
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:60',
            'ape_pat' => 'nullable|string|max:60',
            'ape_mat' => 'nullable|string|max:60',
            'fecha_nac' => 'nullable|date',
            'telefono' => 'required|digits_between:9,10',
            'email' => 'nullable|email|max:100',
            'no_empleado' => 'nullable|digits_between:1,10',
            'area' => 'nullable',
            'puesto' => 'nullable|string|max:100',
            'estatus' => 'nullable|boolean',
            'fecha_contratacion' => 'nullable|date',
            'salario' => 'nullable|numeric|gt:0'
        ]);

        try {
            Empleado::create([
                'nombre' => $this->nombre,
                'ape_pat' => $this->ape_pat,
                'ape_mat' => $this->ape_mat,
                'fecha_nac' => $this->fecha_nac,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'no_empleado' => $this->no_empleado,
                'area' => $this->area,
                'puesto' => $this->puesto,
                'estatus' => $this->estatus,
                'fecha_contratacion' => $this->fecha_contratacion,
                'salario' => $this->salario
            ]);

            // Limpiar todos los campos
            $this->emit('cerrarModal', 'modal-create-employee');

            /**
             * Limpiar el campo de búsqueda para cargar todos los resultados
             * En primer lugar posicionar el recién agregado
             */
            $this->keyWord = '';

            $this->alert('success', '¡Empleado agregado!', [
                'position' =>  'center',
                // 'text' => '...',
                'timer' =>  1000,
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
    public function edit(Empleado $object)
    {
        $this->selectedId = $object->id;

        $this->nombre = $object->nombre;
        $this->ape_pat = $object->ape_pat;
        $this->ape_mat = $object->ape_mat;
        $this->fecha_nac = $object->fecha_nac;
        $this->telefono = $object->telefono;
        $this->email = $object->email;
        $this->no_empleado = $object->no_empleado;
        $this->area = $object->area;
        $this->puesto = $object->puesto;
        $this->estatus = $object->estatus;
        $this->fecha_contratacion = $object->fecha_contratacion;
        $this->salario = $object->salario;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:60',
            'ape_pat' => 'nullable|string|max:60',
            'ape_mat' => 'nullable|string|max:60',
            'fecha_nac' => 'nullable|date',
            'telefono' => 'required|digits_between:9,10',
            'email' => 'nullable|email|max:100',
            'no_empleado' => 'nullable|digits_between:1,10',
            'area' => 'nullable',
            'puesto' => 'nullable|string|max:100',
            'estatus' => 'nullable|boolean',
            'fecha_contratacion' => 'nullable|date',
            'salario' => 'nullable|numeric|gt:0'
        ]);

        try {
            $record = Empleado::findOrFail($this->selectedId);

            $record->update([
                'nombre' => $this->nombre,
                'ape_pat' => $this->ape_pat,
                'ape_mat' => $this->ape_mat,
                'fecha_nac' => $this->fecha_nac,
                'telefono' => $this->telefono,
                'email' => $this->email,
                'no_empleado' => $this->no_empleado,
                'area' => $this->area,
                'puesto' => $this->puesto,
                'estatus' => $this->estatus,
                'fecha_contratacion' => $this->fecha_contratacion,
                'salario' => $this->salario
            ]);

            $this->emit('cerrarModal', 'modal-edit-employee');

            $this->alert('success', '¡Actualizado!', [
                'position' =>  'center',
                // 'text' => '...',
                'timer' =>  1000,
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
            $empleado = Empleado::find($this->selectedId);

            $this->confirm('¿Quieres eliminar a '.$empleado->nombre.'?', [
                'confirmButtonText' =>  'Eliminar',
                'cancelButtonText' => 'Cancelar',
                'onConfirmed' => [
                    'component' => 'empleados',
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
            Empleado::destroy($this->selectedId);

            $this->cancel();

            $this->alert('success', '¡El registro se ha eliminado!', [
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
        $this->reset('selectedId', 'nombre', 'ape_pat', 'ape_mat', 'fecha_nac', 'telefono', 'email', 'no_empleado', 'area', 'puesto', 'estatus', 'fecha_contratacion', 'salario');

        $this->estatus = true;

        $this->resetErrorBag();
    }
}
