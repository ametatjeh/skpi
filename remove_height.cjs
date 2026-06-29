const fs = require('fs');

const files = [
    'c:/XPROJECT/x6/resources/views/auth/login-mahasiswa.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-admin.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-fakultas.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-prodi.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-pusat-bahasa.blade.php'
];

files.forEach(file => {
    if (!fs.existsSync(file)) return;
    let content = fs.readFileSync(file, 'utf8');

    // Remove html, body { height: 100%; }
    content = content.replace(/\s*html,\s*body\s*\{\s*height:\s*100%;\s*\}/, '');

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Removed height 100% from login pages!");
