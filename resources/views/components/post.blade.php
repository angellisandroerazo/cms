<article>
    <div class="m-5 shadow-xl card bg-base-100 w-96">
        <figure>
            <img class="w-96 h-52" src="{{$image}}" alt="img-post" />
        </figure>
        <div class="card-body">
            <div class="justify-end gap-3 card-actions m-2">
                <div class="badge badge-primary">{{$author}}</div>
                <div class="badge badge-primary">{{$category}}</div>
                <div class="badge badge-primary">{{$created_at}}</div>
            </div>
            <h2 class="card-title">
                {{$title}}
            </h2>
            <div>
                {{$body}}
            </div>
            <div class="flex justify-end">
                <a class="link link-primary" href="/{{$slug}}">Ver post</a>
            </div>
        </div>

    </div>
</article>
