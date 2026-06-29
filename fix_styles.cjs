const fs = require('fs');

let file = 'c:/XPROJECT/x6/resources/views/partials/styles.blade.php';
let content = fs.readFileSync(file, 'utf8');

// Remove <style> and </style>
content = content.replace('<style>\n', '');
content = content.replace('</style>', '');

fs.writeFileSync(file, content, 'utf8');
console.log("Fixed styles.blade.php");
