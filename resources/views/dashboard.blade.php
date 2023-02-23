<x-app-layout>
    <style>
        .class {
            border-radius: 4px;
            border: 1px solid black;
            margin: 8px;
            padding: 16px;
        }
         /*class="class"*/
    </style>

    <x-slot name="header">
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div>
            @foreach($images as $image)
                <div class="class">
                    <h2>{{ $image->id }}</h2>
                    <label>@ {{ $image->user->user_name }}</label>
                    <img src="{{ 'images_DB/' . $image->image_path }}" alt="{{ 'images_DB/' . $image->image_path }}"/>
                    <div>
                        <div>
                            <label>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $image->created_at)->longRelativeDiffForHumans()}}
                            </label>
                            <br>
                            <label>
                                Likes »
                                <span id="count{{$image->id}}">
                                    {{count($image->likes)}}
                                </span>
                            </label>
                            <br>
                            <label>
                                Comments » {{count($image->comments)}}
                                <a href="img_detail/{{$image->id}}" class="class">
                                    Ver todos
                                </a>
                            </label>
                            <br>
                            <label id="comment{{$image->id}}"></label>
                        </div>
                        <div>
                            @if(count($image->likes)>0)
                                @if(!$image->likes->where('user_id',Auth::user()->id)->isEmpty())
                                    <img onclick="handle(this, {{ $image->id }})" id="like" src="images/heart.svg" alt="{{ $image->id }}">
                                @else
                                    <img onclick="handle(this, {{ $image->id }})" id="no_like" src="images/heart_no.svg" alt="{{ $image->id }}">
                                @endif
                            @else
                                <img onclick="handle(this, {{ $image->id }})" id="no_like" src="images/heart_no.svg" alt="{{ $image->id }}">
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('save.comment') }}">
                        @csrf
                        <textarea name="comment" cols="25" rows="1" required></textarea>
                        <input type="hidden" value="{{$image->id}}" name="image">
                        <button type="submit" class="class">Comment</button>
                    </form>

                    <br>
                </div>
            @endforeach
        </div>
</x-app-layout>
