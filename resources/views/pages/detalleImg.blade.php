<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle Imagen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 flex items-center justify-center">
            <div
                class="bg-white overflow-hidden w-96 shadow-xl shadow-indigo-500/40 sm:rounded-lg p-4 flex flex-col items-center justify-center">
                <labe>{{$image->user->name.'@'.$image->user->user_name }}</labe>
                <img style="width: 380px" src="{{'/images_DB/'.$image->image_path}}" alt="No carga">
                <labe>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->longRelativeDiffForHumans()}}</labe>
                <br>
                <ul class="list-disc list-inside">
                    @foreach($image->comments as $comment)
                        <form method="POST" action="{{ route('delete.comentario') }}">
                            @csrf
                            <li>{{$comment->content}} <input class="bg-indigo-500 rounded-lg p-2 ml-1 text-white"
                                                             type="submit" value="Eliminar"></li>
                            <input type="hidden" name="commentID" value="{{$comment->id}}">
                            <br>
                        </form>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
