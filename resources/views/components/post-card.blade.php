<div class="bg-gray-800 text-white rounded-lg p-4 shadow-md mb-6">
    <a href="{{ url('category/show/' . $post->id) }}" class="text-lg font-semibold hover:underline">
        {{ $post->title }}
    </a>

    <p class="text-sm text-gray-300 mb-2">{{ $post->created_at->diffForHumans() }}</p>

    @php
        $poster = $post->poster;
        $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)(\?.*)?$/i', $poster);
    @endphp

    @if ($poster && $isImage)
        <div class="mt-2">
            <img src="{{ $poster }}" alt="Imagen" class="w-full max-h-64 object-cover rounded mt-2">
        </div>
    @endif

    <p class="text-gray-400 text-sm mt-2">Publicado por: {{ $post->user->name ?? 'Anónimo' }}</p>

    @if ($editable ?? false)
        <form method="POST" action="{{ url('category/update-habilitated/' . $post->id) }}" class="mt-4">
            @csrf
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="habilitated" value="1" {{ $post->habilitated ? 'checked' : '' }}>
                <span>Habilitado</span>
            </label>
            <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded">
                Guardar
            </button>
        </form>
    @endif
</div>