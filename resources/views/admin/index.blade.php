<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Message -->
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 1. Resume Update Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section class="max-w-xl">
                    <header>
                        <h3 class="text-lg font-medium text-gray-900">Update Resume PDF</h3>
                        <p class="mt-1 text-sm text-gray-600">Upload your latest resume PDF. It will instantly update on your portfolio.</p>
                    </header>

                    <form method="post" action="{{ route('admin.resume.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="resume" value="Select PDF Resume" />
                            <input id="resume" name="resume" type="file" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required />
                            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
                        </div>

                        <x-primary-button>{{ __('Upload Resume') }}</x-primary-button>
                    </form>
                </section>
            </div>

            <!-- 2. Add New Project Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h3 class="text-lg font-medium text-gray-900">Add New Project</h3>
                        <p class="mt-1 text-sm text-gray-600">Fill in the project details to showcase it on your portfolio.</p>
                    </header>

                    <form method="post" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" value="Project Title" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Tech Stack -->
                            <div>
                                <x-input-label for="tech_stack" value="Tech Stack (e.g. Laravel, Tailwind, MySQL)" />
                                <x-text-input id="tech_stack" name="tech_stack" type="text" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tech_stack')" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" value="Project Description" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Live URL -->
                            <div>
                                <x-input-label for="live_url" value="Live Demo URL (Optional)" />
                                <x-text-input id="live_url" name="live_url" type="url" class="mt-1 block w-full" />
                            </div>

                            <!-- GitHub URL -->
                            <div>
                                <x-input-label for="github_url" value="GitHub URL (Optional)" />
                                <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" />
                            </div>

                            <!-- Thumbnail Image -->
                            <div>
                                <x-input-label for="thumbnail" value="Project Thumbnail Image" />
                                <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mt-1" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Project') }}</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>

            <!-- 3. Existing Projects List Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Manage Projects</h3>
                        <p class="mt-1 text-sm text-gray-600">Here is a list of all your uploaded portfolio projects.</p>
                    </header>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tech Stack</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($projects as $project)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $project->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $project->tech_stack }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No projects added yet. Add your first project above!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>