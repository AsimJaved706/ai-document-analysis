<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.email-templates.index') }}"
                class="p-2 hover:bg-gray-100 rounded-full transition-colors text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-2xl text-gray-900 leading-tight">Edit Email Template: <span
                        class="text-teal-600">{{ $name }}</span></h2>
                <p class="text-sm text-gray-600 mt-0.5">Modify the raw Markdown and Blade syntax for this email</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('admin.email-templates.update', $name) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <label for="content" class="block text-sm font-semibold text-gray-900">
                                Template Content (Markdown/Blade)
                            </label>

                            <!-- Help indicators based on filename -->
                            @if($name === 'profile-update.blade.php')
                                <div class="text-xs text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">
                                    Available Variables: <code>&#123;&#123; $user->name &#125;&#125;</code>,
                                    <code>&#123;&#123; $message &#125;&#125;</code>
                                </div>
                            @elseif($name === 'missing-documents.blade.php')
                                <div class="text-xs text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">
                                    Available Variables: <code>&#123;&#123; $user->name &#125;&#125;</code>,
                                    <code>&#123;&#123; $missingDocs &#125;&#125;</code>
                                </div>
                            @elseif($name === 'correction-needed.blade.php')
                                <div class="text-xs text-gray-600 bg-gray-100 px-3 py-1.5 rounded-full">
                                    Available Variables: <code>&#123;&#123; $user->name &#125;&#125;</code>,
                                    <code>&#123;&#123; $document->type->name &#125;&#125;</code>,
                                    <code>&#123;&#123; $rejectionReason &#125;&#125;</code>
                                </div>
                            @endif
                        </div>

                        <div
                            class="rounded-lg border border-gray-300 overflow-hidden focus-within:ring-2 focus-within:ring-teal-500 focus-within:border-teal-500">
                            <textarea id="content" name="content" rows="25"
                                class="w-full font-mono text-sm p-4 border-0 focus:ring-0 resize-y bg-gray-50 text-gray-800"
                                spellcheck="false" required>{{ old('content', $content) }}</textarea>
                        </div>

                        @error('content')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                        <a href="{{ route('admin.email-templates.index') }}"
                            class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white px-6 py-2 rounded-md font-semibold shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Save Template
                        </button>
                    </div>
                </form>
            </div>

            <!-- Markdown Reference -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="font-semibold text-gray-900">Markdown & Blade Reference</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-600">
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Formatting</h4>
                            <ul class="space-y-2 font-mono">
                                <li><code># Heading 1</code> <span class="font-sans text-gray-500 ml-2">Header</span>
                                </li>
                                <li><code>**Bold Text**</code> <span class="font-sans text-gray-500 ml-2">Bold</span>
                                </li>
                                <li><code>[Link Text](http://url)</code> <span
                                        class="font-sans text-gray-500 ml-2">Links</span></li>
                                <li><code>---</code> <span class="font-sans text-gray-500 ml-2">Horizontal Rule</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-2">Laravel Mail Components</h4>
                            <ul class="space-y-2 font-mono">
                                <li class="text-xs">
                                    <code>@@component('mail::button', ['url' => '...'])<br>Button Text<br>@@endcomponent</code>
                                </li>
                                <li class="text-xs mt-2">
                                    <code>@@component('mail::panel')<br>Panel Content<br>@@endcomponent</code>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>