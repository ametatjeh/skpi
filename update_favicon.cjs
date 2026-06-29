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

    content = content.replace(/faviconx\.ico/g, 'favicon.ico');

    if (content !== original) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Updated:', filePath);
    }
  }
});
