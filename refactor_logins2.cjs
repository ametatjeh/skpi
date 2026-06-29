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

    // 4. Wrap with main and include footer properly
    if (!content.includes('<main style="flex: 1')) {
        // Find the start of the login wrapper
        let wrapperIndex = content.search(/<div class="login-wrapper"/);
        if (wrapperIndex !== -1) {
            content = content.substring(0, wrapperIndex) + '    <main style="flex: 1; display: flex; align-items: center; justify-content: center; width: 100%; padding: 40px 16px;">\n        ' + content.substring(wrapperIndex);
            
            let footerStart = content.indexOf('<!-- Particles JS -->');
            if (footerStart === -1) footerStart = content.indexOf('</body>');

            if (footerStart !== -1) {
                content = content.substring(0, footerStart) + '    </main>\n\n    @include(\'partials.footer\')\n\n    ' + content.substring(footerStart);
            }
        }
    }

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Refactored login pages wrappers!");
