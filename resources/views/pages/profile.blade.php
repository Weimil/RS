<x-app-layout>
    <style>
        .class {
            border-radius: 4px;
            border: 1px solid black;
            margin: 8px;
            padding: 16px;
            display: block;
        }

        /* class="class" */
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div>
        <div>
            <div>
                <div>
                    <div class="class">
                        <img src="{{'storage/'.$user->profile_photo_path}}" class="class" alt="Not found">
                        <div class="class">
                            <div>@ {{$user->user_name}} </div>
                            <label>{{$user->name}} {{$user->surname}}</label><br>
                            <label>{{$user->email}}</label><br>
                            <label>Friends » {{count($friends)}}</label>
                        </div>
                    </div>
                </div>
                <div>
                    @foreach($requests as $request)
                        <div class="class">

                            <div class="class">
                                <label>{{ $users->find($request->sender_id)->name }}</label> »
                                <label>{{ $users->find($request->recipient_id)->name }}</label>
                            </div>

                            @if($request->recipient_id === Auth::user()->id)

                                <form action="{{ route('friendship.accept') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$request->sender_id}}" name="sender">
                                    <button class="class"> Aceptar</button>
                                </form>

                                <form action="{{ route('friendship.deny') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$request->sender_id}}" name="sender">
                                    <button class="class"> Denegar</button>
                                </form>

                            @endif
                            @if($request->sender_id === Auth::user()->id)

                                <form action="{{ route('friendship.cancel') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$request->recipient_id}}" name="recipient">
                                    <input type="hidden" value="{{$request->sender_id}}" name="sender">
                                    <button class="class"> Cancelar</button>
                                </form>

                            @endif

                        </div>
                    @endforeach
                </div>
                <div class="class">
                    <label>Imagenes<label> {{count($images)}} </label></label>
                    <hr style="border: 1px solid black;">
                    @foreach($images as $image)
                        <div class="class">
                            <h2>{{ $image->id }}</h2>
                            <label>@ {{ $image->user->user_name }}</label>
                            <img src="{{ 'images_DB/' . $image->image_path }}"
                                 alt="{{ 'images_DB/' . $image->image_path }}"/>
                            <div>
                                <div>
                                    <label>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->longRelativeDiffForHumans()}}
                                    </label>
                                    <br>
                                    <label>
                                        Likes »
                                        <label id="count{{$image->id}}">
                                            {{count($image->likes)}}
                                        </label>
                                    </label>
                                    <br>
                                    <label>
                                        Comments » {{count($image->comments)}}
                                        <a href="img_detail/{{$image->id}}" class="class">
                                            Ver todos
                                        </a>
                                    </label>
                                    <br>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
