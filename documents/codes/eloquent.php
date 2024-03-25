$subjects = Subject::where(function ($query) {
            if ($this->idSearch != '') {
                $query->where('id', 'like', '%'.$this->idSearch.'%');
            }
            if ($this->nameSearch != '') {
                $query->where('name', 'like', '%'.$this->nameSearch.'%');
            }
        })->paginate(10, pageName: 'subjectsPage');