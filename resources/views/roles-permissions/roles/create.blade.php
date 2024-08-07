<x-layout>

    <div class="max-w-2xl mx-auto p-4 bg-slate-200 dark:slate-900 rounded-lg">
        <x-header> Create New Permission</x-header>
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="mb-6">
                <label for="default-input"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission Name</label>
                <input type="text" name="name" id="default-input" value="{{ old('name')}}"
                    class="@error('name') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('name')
                    <span class="text-red-500 text=sm">{{ $message }}</span>
                @enderror
            </div>
         
        
            <div class="mb-6">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>

            </div>
        </form>
    </div>

</x-layout>
