<div>
    {{__('general.Theme')}}
    <input type="checkbox" class="theme-checkbox" id="themeswitcher"
           {{Cookie::get('theme') != false && Cookie::get('theme') == 'light' ? '' : 'checked'}} wire:click="changeTheme">
    <script>
        document.getElementById('themeswitcher').addEventListener('click', () => {
            if (document.documentElement.getAttribute('data-theme') === 'light') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
            else {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })
    </script>
</div>
