<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mypage') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.biography', ['biography'=>$biography])
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="p-4">
                                <label for="description">Description</label></br>
                                <textarea id="title" class="form-control" name="description"
                                       placeholder="Enter Post description" required></textarea>
                            </div>
                            <div class="mt-2 p-4">
                                <label for="img_url">URL</label></br>
                                <input type="text" id="body" class="form-control" name="img_url" placeholder="Enter img_url"
                                          rows="" required></input>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 p-4">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            </div>
                        </div>
    </form>
</div>
</div>
</div>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            {{Log::emergency('mypage.show ')}}
                @include('posts.show', ['posts' => $posts])
            </div>
        </div>
    </div>
</x-app-layout>