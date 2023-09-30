<div>
    {{__('general.Theme')}}
    <input type="checkbox" class="theme-checkbox" id="themeswitcher" {{Cookie::get('theme') != false && Cookie::get('theme') == 'light' ? '' : 'checked'}} wire:click="changeTheme()">
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('themeChange', (e) => {
               document.documentElement.setAttribute('data-theme', e);
            });
        });
    </script>
</div>
