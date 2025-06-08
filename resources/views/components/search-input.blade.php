<form method="GET" action="{{ url('category') }}" class="mb-6">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar posts..."
            class="px-4 py-2 rounded w-full text-black"
        />
</form>