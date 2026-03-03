const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(file => {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walk(file));
        } else if (file.endsWith('.blade.php')) {
            results.push(file);
        }
    });
    return results;
}

const files = walk('d:/Projects/MVP AI document analysis/app/resources/views/admin');
files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    // Replace blue with teal
    let newContent = content.replace(/(bg|text|border|ring|hover:bg|hover:text|hover:border|from|to|via|focus:ring|focus:border)-blue-(\d{1,3})/g, '$1-teal-$2');
    // Replace indigo with emerald
    newContent = newContent.replace(/(bg|text|border|ring|hover:bg|hover:text|hover:border|from|to|via|focus:ring|focus:border)-indigo-(\d{1,3})/g, '$1-emerald-$2');

    // Also catch bg-blue-50 or text-blue-50 specifically if not caught
    if (content !== newContent) {
        fs.writeFileSync(file, newContent, 'utf8');
        console.log('Updated ' + file);
    }
});
