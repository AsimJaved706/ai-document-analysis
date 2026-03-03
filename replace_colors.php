<?php
$dir = __DIR__ . '/resources/views/admin';

function replaceColorsInDir($dir)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
            $path = $file->getPathname();
            $content = file_get_contents($path);

            // Replace blue with teal
            $newContent = preg_replace('/(bg|text|border|ring|hover:bg|hover:text|hover:border|from|to|via|focus:ring|focus:border)-blue-(\d{2,3})/', '$1-teal-$2', $content);
            // Replace indigo with emerald
            $newContent = preg_replace('/(bg|text|border|ring|hover:bg|hover:text|hover:border|from|to|via|focus:ring|focus:border)-indigo-(\d{2,3})/', '$1-emerald-$2', $newContent);

            if ($newContent !== $content) {
                file_put_contents($path, $newContent);
                echo "Updated: $path\n";
            }
        }
    }
}
replaceColorsInDir($dir);
echo "Done.\n";
