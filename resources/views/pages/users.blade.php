<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 flex items-center justify-center flex-col">
            <div class="bg-white overflow-hidden w-1/2 shadow-xl shadow-indigo-500/40 sm:rounded-lg p-5 mb-5 flex items-center justify-center">
                <form action="{{ route('usuarios.search') }}" method="GET">
                    <input type="search" placeholder="Buscar" name="buscar" id="Buscador"/>
                    <button class="bg-indigo-500 text-white p-2" type="submit">Buscar</button>
                </form>
            </div>
            <div class="bg-white overflow-hidden w-1/2 shadow-xl shadow-indigo-500/40 sm:rounded-lg p-5 ">
                @foreach($users as $user)
                    <hr>
                    <div class="flex items-center p-3 justify-around">
                        <div>
                            <img class="w-14" src="{{'storage/'.$user->profile_photo_path}}" alt="Sin imagen">
                            <h1>{{$user->name}} {{$user->surname}}  <a class="text-indigo-500" href="usuarios/{{$user->id}}"><span>@</span>{{$user->user_name}}</a></h1>
                        </div>
                        @if($friends->find($user->id))
                            Amigo
                        @elseif($pending->where('recipient_id', $user->id)->count() > 0)
                            Pending...
                        @elseif($user->id!=\Auth::user()->id)
                            <div>
                                <form action="{{ route('send.friend') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$user->id}}" name="recipient">
                                    <button class="bg-indigo-500 text-white p-2 rounded-2xl">Send friend request</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
