<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subir Imagen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-4 sm:rounded-lg">
                <form method="POST" action="{{ route('save.image') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-jet-label for="descripcion" value="{{ __('Image') }}"/>
                        <x-jet-input class="block mt-1 w-full" type="text" name="descripcion" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="image" value="{{ __('File') }}"/>
                        <x-jet-input id="image" class="block mt-1 w-full" type="file" name="image" required/>
                    </div>
                    <br>
                    <x-jet-button class="ml-4">
                        {{ __('Subir Imagen') }}
                    </x-jet-button>
                </form>
                {{--@foreach($images as $image)--}}
                {{--    <img src="{{ $image}}" alt="No carga"><br>--}}
                {{--@endforeach--}}

            </div>
        </div>
    </div>
</x-app-layout>



