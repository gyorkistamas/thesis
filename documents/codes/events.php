// Esemény küldése adatokkal:

$this->dispatch('multiple-select-students', data: array_column($this->selected_items, 'id'));

// Esemény fogadása komponensen belül:

#[On('single-select-teacher')]
public function setManager($data)
{
    $this->subjectManager = $data;
}

// Események fogadása JavaScripten belül:

<script>
    Livewire.on('closeSubjectCreateModal', () => {
        subjectCreateModal.close();
    })
</script>