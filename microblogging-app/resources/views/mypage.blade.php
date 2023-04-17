<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mypage') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    {{ __("This is your page!") }}
                </div>
            </div>
        </div>
    </div>

    <form action="" method="POST" class="mt-6 space-y-6">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="description">Description</label>
                                <input type="text" id="title" class="form-control" name="description"
                                       placeholder="Enter Post description" required>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="img_url">URL</label>
                                <textarea id="body" class="form-control" name="img_url" placeholder="Enter img_url"
                                          rows="" required></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            </div>
                        </div>
    </form>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @include('posts.show', ['post' => $posts])
            </div>
        </div>
    </div>
</x-app-layout>