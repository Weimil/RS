<x-app-layout>
    <style>
        .class {
            border-radius: 4px;
            border: 1px solid black;
            margin: 8px;
            padding: 16px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div>
        <div>
            <div class="class">
                <form action="{{ route('users.search') }}" method="GET">
                    <input type="search" placeholder="Buscar" name="buscar" id="Buscador"/>
                    <button type="submit" class="class">Buscar</button>
                </form>
            </div>
            @foreach($users as $user)
                @if($user->id === Auth::user()->id)
                    @continue
                @endif
                <div class="class">
                    <hr>
                    <div>
                        <div>
                            <img class="w-14" src="{{'storage/'.$user->profile_photo_path}}" alt="Sin imagen">
                            <h1>
                                {{$user->name}} {{$user->surname}}
                                <a href="usuarios/{{$user->id}}"><span>@</span>{{$user->user_name}}</a>
                            </h1>
                        </div>
                        <div class="class">
                            @if($friends->find($user->id))
                                Amigo
                            @elseif($pending->where('recipient_id', $user->id)->count() > 0)
                                Pending...
                            @else
                                <div>
                                    <form action="{{ route('friendship.send') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$user->id}}" name="recipient">
                                        <button class="class"> Send friend request</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
