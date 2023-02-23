<x-app-layout>
    <style>
        .class {
            border-radius: 4px;
            border: 1px solid black;
            margin: 8px;
            padding: 16px;
            display: block;
        }

        /* class="class"*/
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle Imagen') }}
        </h2>
    </x-slot>

    <div>
        <div>
            <div class="class">
                <labe>{{$image->user->name.'@'.$image->user->user_name }}</labe>
                <img style="width: 380px" src="{{'/images_DB/'.$image->image_path}}" alt="No carga">
                <labe>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->longRelativeDiffForHumans()}}</labe>
                <br>
                @foreach($image->comments as $comment)
                    <div class="class">
                        <form method="POST" action="{{ route('delete.comment') }}">
                            @csrf
                            <div class="class">{{$comment->content}}</div>
                                <input  class="class" type="submit" value="Eliminar">
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <br>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
