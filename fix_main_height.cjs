const fs = require('fs');

const files = [
    'c:/XPROJECT/x6/resources/views/auth/register-email.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-mahasiswa.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-admin.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-fakultas.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-prodi.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/login-pusat-bahasa.blade.php'
];

files.forEach(file => {
    if (!fs.existsSync(file)) return;
    let content = fs.readFileSync(file, 'utf8');

    // Replace the main style to include min-height calc
    content = content.replace(
        /<main style="flex: 1; display: flex;/g, 
        '<main style="flex: 1; min-height: calc(100vh - 200px); display: flex;'
    );

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Added min-height to main tags!");
