<x-layout>
    <div class="max-w-2xl mx-auto p-4 bg-slate-200 dark:bg-slate-900 rounded-lg">
        <x-header> Assigning permissions to the role: {{ $role->name }}</x-header>
        <form method="POST" action="{{ 
         route('roles.give-permissions.store', $role->id)
          }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="role-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Role Name
                </label>
                <input type="text" id="role-name" value="{{ $role->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                          dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    disabled>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Assign Permissions
                </label>
                @foreach ($permissions as $permission)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded 
                                                  focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 
                                                  focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            @if (in_array($permission->id, $rolePermissions)) checked @endif>
                        <label for="permission-{{ $permission->id }}"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mb-6">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                                           font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 
                                           dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Save Permissions
                </button>
            </div>
        </form>
    </div>
</x-layout>
