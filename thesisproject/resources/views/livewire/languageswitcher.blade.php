<div class="join join-horizontal">
    <input class="join-item btn btn-xs" type="radio" name="options" aria-label="HUN" wire:click="setHungarian" {{App::currentLocale() == 'hun' ? 'checked' : ''}}/>
    <input class="join-item btn btn-xs" type="radio" name="options" aria-label="ENG" wire:click="setEnglish" {{App::currentLocale() == 'en' ? 'checked' : ''}}/>
</div>
