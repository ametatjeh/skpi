const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
  fs.readdirSync(dir).forEach(f => {
    let dirPath = path.join(dir, f);
    let isDirectory = fs.statSync(dirPath).isDirectory();
    isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
  });
}

walkDir('c:/XPROJECT/x6/resources/views', function(filePath) {
  if (filePath.endsWith('.blade.php')) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    content = content.replace(/<link rel="icon" type="image\/x-icon" href="{{ asset\('favicon\.ico'\) }}">/g, '<link rel="shortcut icon" type="image/x-icon" href="{{ asset(\'favicon.ico\') }}?v=2">\n    <link rel="icon" type="image/x-icon" href="{{ asset(\'favicon.ico\') }}?v=2">');
    content = content.replace(/<link rel="apple-touch-icon" href="{{ asset\('favicon\.ico'\) }}">/g, '<link rel="apple-touch-icon" href="{{ asset(\'favicon.ico\') }}?v=2">');

    if (content !== original) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Updated:', filePath);
    }
  }
});
