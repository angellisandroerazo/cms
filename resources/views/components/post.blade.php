<article>
    <a class="m-5 shadow-xl w-72 card bg-base-100 md:lg:w-96 group" href="/post/{{$slug}}">
        <figure>
            <img class="h-40 w-72 md:lg:w-96 md:lg:h-52" src="{{$image}}" alt="img-post" />
        </figure>
        <div class="card-body">
            <div class="justify-end gap-3 m-2 card-actions">
                <div class="badge badge-primary">{{$category}}</div>
            </div>
            <span class="flex justify-end my-2 text-xs">{{$created_at}}</span>
            <h2 class=" card-title group-hover:text-primary group-hover:underline">
                {{$title}}
            </h2>
        </div>
    </a>
</article>
