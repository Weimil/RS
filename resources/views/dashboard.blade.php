<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 flex items-center justify-center">
            <div
                class="bg-white overflow-hidden w-96 shadow-xl shadow-indigo-500/40 sm:rounded-lg p-4 flex flex-col items-center justify-center">
                @foreach($images as $image)
                    <labe>{{$image->user->name.'/@'.$image->user->user_name }}</labe>
                    <img style="width: 380px; border-radius: 5px; margin-bottom: 5px"
                         class="border-solid border-2 border-indigo-500" src="{{'images_DB/'.$image->image_path}}"
                         alt="No carga">
                    <div class="flex mb-4">
                        <div class="flex justify-center items-center flex-col">
                            <label>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->longRelativeDiffForHumans()}}</label>
                            <label>Likes --> <span id="count{{$image->id}}">{{count($image->likes)}}</span></label>
                            <label>Commentarios --> {{count($image->comments)}}
                                <a class="text-indigo-500 hover:underline" href="img_detalle/{{$image->id}}">Ver
                                    todos</a>
                            </label>
                            <label id="nuevoComent{{$image->id}}"></label>
                        </div>
                        <div class="ml-10">
                            @if(count($image->likes)>0)
                                @if(!$image->likes->where('user_id',\Auth::user()->id)->isEmpty())
                                    <img class="w-14" onclick="hola(this)" id="like" src="images/favorito.png"
                                         alt="{{$image->id}}">
                                @else
                                    <img class="w-14" onclick="hola(this)" id="Nolike" src="images/favoritoNo.png"
                                         alt="{{$image->id}}">
                                @endif
                            @else
                                <img class="w-14" onclick="hola(this)" id="Nolike" src="images/favoritoNo.png"
                                     alt="{{$image->id}}">
                            @endif
                        </div>
                    </div>
                    <form method="POST" class="flex" action="{{ route('save.comentario') }}">
                        @csrf
                        <textarea placeholder="Que piensas?" name="comentario" cols="25" rows="1"></textarea>
                        <input type="hidden" value="{{$image->id}}" name="imagenCommentario">
                        <input class="bg-indigo-500 rounded-lg p-2 ml-1 text-white" type="submit" value="Comentar">
                    </form>

                    {{--                    <div  class="flex">--}}
                    {{--                        <textarea placeholder="Que piensas?" name="comentario{{$image->id}}" cols="25" rows="1"></textarea>--}}
                    {{--                        --}}{{--                    <input type="hidden" value="{{$image->id}}" name="imagenCommentario">--}}
                    {{--                        <input onclick="comentar(this)" id="{{$image->id}}.{{\Auth::user()->id}}" class="bg-indigo-500 rounded-lg p-2 ml-1 text-white" type="submit" value="Comentar">--}}
                    {{--                    </div>--}}
                    <br>
                    <hr class="w-48 h-1 border-0 mb-3 rounded dark:bg-gray-700" style="background-color: indigo">
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
