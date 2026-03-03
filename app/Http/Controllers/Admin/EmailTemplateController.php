<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of email templates.
     */
    public function index()
    {
        $directory = resource_path('views/emails');
        $files = File::files($directory);

        $templates = collect($files)->map(function ($file) {
            return [
                'name' => $file->getFilename(),
                'path' => $file->getRelativePathname(),
                'size' => $file->getSize(),
                'last_modified' => \Carbon\Carbon::createFromTimestamp($file->getMTime()),
            ];
        });

        return view('admin.email-templates.index', compact('templates'));
    }

    /**
     * Show the form for editing the specified template.
     */
    public function edit(string $name)
    {
        // Simple security check: enforce filename format (e.g. name.blade.php)
        // and prevent directory traversal
        if (!preg_match('/^[a-zA-Z0-9_-]+\.blade\.php$/', $name)) {
            abort(404);
        }

        $path = resource_path('views/emails/' . $name);

        if (!File::exists($path)) {
            abort(404);
        }

        $content = File::get($path);

        return view('admin.email-templates.edit', compact('name', 'content'));
    }

    /**
     * Update the specified template in storage.
     */
    public function update(Request $request, string $name)
    {
        // Simple security check: enforce filename format
        if (!preg_match('/^[a-zA-Z0-9_-]+\.blade\.php$/', $name)) {
            abort(404);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $path = resource_path('views/emails/' . $name);

        if (!File::exists($path)) {
            abort(404);
        }

        // Save the raw content to the blade file
        File::put($path, $request->input('content'));

        return redirect()->route('admin.email-templates.index')
            ->with('success', "Template '{$name}' has been updated successfully.");
    }
}
