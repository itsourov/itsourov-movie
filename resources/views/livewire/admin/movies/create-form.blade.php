<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-card class="md:col-span-2 space-y-3">
            <div>
                <div class="flex items-center gap-2">
                    <x-input.text wire:model.lazy="tmdb_id" placeholder="Enter TMDB id" />
                    <x-button.primary wire:click="getInfo" class=" flex-shrink-0 py-1 h-min">Get movie info
                    </x-button.primary>
                </div>
                <x-input.error :messages="$errors->get('tmdb_id')" />
            </div>



            <div>
                <x-input.label value="{{ __('Movie Title') }}" />
                <x-input.text type="text" wire:model.lazy="array.title" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('title')" />
            </div>
            <div>
                <x-input.label value="{{ __('Movie Original Title') }}" />
                <x-input.text type="text" wire:model.lazy="original_title" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('original_title')" />
            </div>
            <div>
                <x-input.label value="{{ __('synopsis') }}" />
                <x-input.text type="text" wire:model.lazy="array.synopsis" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('synopsis')" />
            </div>
            <div>
                <x-input.label value="{{ __('release_date') }}" />
                <x-input.text type="date" wire:model.lazy="release_date" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('release_date')" />
            </div>
            <div>
                <x-input.label value="{{ __('runtime in min') }}" />
                <x-input.text type="text" wire:model.lazy="runtime" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('runtime')" />
            </div>
            <div>
                <x-input.label value="{{ __('poster') }}" />
                <x-input.text type="text" wire:model.lazy="poster" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('poster')" />
            </div>
            <div>
                <x-input.label value="{{ __('backdrop') }}" />
                <x-input.text type="text" wire:model.lazy="backdrop" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('backdrop')" />
            </div>
            <div>
                <x-input.label value="{{ __('rating') }}" />
                <x-input.text type="text" wire:model.lazy="rating" placeholder="Enter info here" />
                <x-input.error :messages="$errors->get('rating')" />
            </div>

        </x-card>
        <x-card>asd</x-card>
    </div>

    <div wire:loading>
        <div
            class="fixed z-40 flex tems-center justify-center inset-0 bg-gray-700 dark:bg-gray-900 dark:bg-opacity-50 bg-opacity-50 transition-opacity">
            <div class="flex items-center justify-center ">
                <div class="w-40 h-40 border-t-4 border-b-4 border-green-900 rounded-full animate-spin">
                </div>
            </div>
        </div>
    </div>
</div>
