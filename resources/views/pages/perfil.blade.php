<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 flex items-center justify-center">
            <div class="bg-white overflow-hidden w-1/2 shadow-xl shadow-indigo-500/40 sm:rounded-lg p-5 ">
                {{--                flex flex-col items-center justify-center--}}
                <div class="text-center text-2xl mb-1">@<label>{{$user->user_name}}</label></div>
                <hr class="h-1 bg-indigo-500 border-0 rounded">
                <div class="flex items-center ml-24 mb-1 mt-1 mb-1">
                    <img src="{{'storage/'.$user->profile_photo_path}}" class="w-1/4" alt="No tienes foto">
                    <div>
                        <label class="ml-5">{{$user->name}} {{$user->surname}}</label><br>
                        <label class="ml-5">{{$user->email}}</label>
                    </div>
                </div>
                <hr class="h-1 bg-indigo-500 border-0 rounded">
                <div class=" m-4 grid grid-flow-col auto-cols-max flex items-center justify-around">
                    <div class="col"><span>Friends - {{count($friends)}}</span></div>
                    <div class="col">
                        @foreach($peticiones as $peticion)
                            @if($peticion->recipient_id === \Auth::user()->id)
                                <form action="{{ route('aceptar.amistad') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$peticion->sender_id}}" name="sender">
                                    <button class="bg-green-400 text-white p-2">
                                        Aceptar {{$users->find($peticion->sender_id)->name}}</button>
                                </form>
                                <form action="{{ route('denegar.amistad') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$peticion->sender_id}}" name="sender">
                                    <button class="bg-red-500 text-white p-2">
                                        Denegar {{$users->find($peticion->sender_id)->name}}</button>
                                </form>
                            @endif
                            <br>
                            @if($peticion->sender_id === \Auth::user()->id)
                                <form action="{{ route('cancelar.amistad') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$peticion->recipient_id}}" name="recipient">
                                    <input type="hidden" value="{{$peticion->sender_id}}" name="sender">
                                    <button class="bg-gray-900 text-white p-2">
                                        Cancelar amistad {{$users->find($peticion->recipient_id)->name}}</button>
                                </form>

                            @endif
                        @endforeach
                    </div>
                </div>
                <hr class="h-1 bg-indigo-500 border-0 rounded">
                <div class="mt-3 flex-col flex items-center justify-center">
                    <h1 class="text-2xl">Imagenes <span
                            class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{count($images)}}</span>
                    </h1>
                    <div class="mt-3 flex items-center justify-center flex-wrap">
                        @foreach($images as $image)
                            <div class="flex items-center justify-center flex-col">
                                <div
                                    class="border-indigo-500 border-2 rounded-lg p-2 w-36 h-36 m-1 flex items-center justify-center">
                                    <img src="{{'images_DB/'.$image->image_path}}" alt="No carga" class="w-32 h-32">
                                </div>
                                <form action="{{ route('delete.image') }}" method="POST">
                                    @csrf
                                    <button class="text-indigo-500 hover:underline" name="imageID" type="submit"
                                            value="{{$image->id}}">Eliminar
                                    </button>
                                </form>
                            </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
