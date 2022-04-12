<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Traits\CrudTrait;

use App\Models\Locator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Livewire\WithPagination;

class Locators extends Component {
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;

    protected $listeners = ['destroy'];
    public $name;

    public function mount()
    {
        //$this->authorize('hasaccess', 'Locators.index');
        $this->manage_title = __('Manage') . ' ' . __('Locators');
        $this->search_label = "Locator Name";
        $this->view_form = 'livewire.locators.form';
        $this->view_table = 'livewire.locators.table';
        $this->view_list  = 'livewire.locators.list';
    }


    /*+----------------------------------------------+
	| Presenta formulario filtrando la búsqueda    |
	+----------------------------------------------+
	 */

	public function render() {
        $this->create_button_label =  $this->record_id ?    __('Update') . ' ' . __('Locator')
                                                        : __('Create') . ' ' . __('Locator');

        $searchTerm = '%' . $this->search . '%';
        return view('livewire.index', [
            'records' => Locator::Name($searchTerm)->paginate($this->pagination),
        ]);
	}

   /*+------------------------+
	| Inicializa variables  |
	+-----------------------+
    */

	private function resetInputFields() {
        $this->record_id = null;
        $this->record = null;
        $this->reset(['name']);
	}

    /*+---------------------------------------------+
    | Valida, crea o actualiza según corresponda  |
    +---------------------------------------------+
    */

	public function store() {

		$this->validate([
            'name'         => 'required|min:3|max:100|unique:locators,name,' . $this->record_id
		]);


		Locator::updateOrCreate(['id' => $this->record_id], [
            'name'         => $this->name,
		]);

        $this->create_button_label = __('Create') . ' ' . __('Locator');
        $this->store_message(__('Locator'));
	}

    /*+------------------------------+
	| Lee Registro Editar o Borar  |
	+------------------------------+
	 */

	public function edit(Locator $record) {
        $this->resetInputFields();
        $this->create_button_label = __('Update') . ' ' . __('Locator');
        $this->record       = $record;
		$this->record_id    = $record->id;
		$this->name         = $record->name;
		$this->openModal();
	}

    /*+----------------------------+
	| Elimina Registro             |
	+------------------------------+
	 */
	public function destroy(Locator $record) {
        $this->delete_record($record,__('Locator') . ' ' . __('Deleted Successfully!!'));
    }
}
