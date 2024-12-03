<div class="flex justify-center p-5">
    <div class="relative w-full max-w-sm overflow-hidden rounded-lg shadow-lg group">

        <div class="relative">
            <img class="object-cover w-full h-48 transition duration-300 transform group-hover:scale-105"
                src="{{$image}}" alt="Imagen del Post">

            <span class="absolute text-xs font-semibold rounded badge badge-primary top-2 left-2">
                {{$category}}
            </span>
        </div>

        <div class="p-5">

            <h2
                class="text-lg font-bold transition-all duration-300 ease-in-out group-hover:text-primary group-hover:underline">
                {{$title}}
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                {{$created_at}}
            </p>
        </div>

        <a href="/post/{{$slug}}"
            class="absolute inset-0 transition duration-300 bg-black bg-opacity-0 group-hover:bg-opacity-10"></a>
    </div>
</div>