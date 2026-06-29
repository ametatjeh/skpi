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

    // 1. Add styles
    if (!content.includes("@include('partials.styles')")) {
        content = content.replace('</style>', "    @include('partials.styles')\n</style>");
    }

    // 2. Fix Body CSS
    content = content.replace(
        /body\s*\{\s*font-family:\s*'Poppins',\s*sans-serif;\s*min-height:\s*100vh;\s*display:\s*flex;\s*align-items:\s*center;\s*justify-content:\s*center;\s*background:.*?\s*padding:.*?\s*color:.*?\s*position:.*?\s*overflow-x:.*?\s*\}/s,
        `body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #fff;
            position: relative;
            overflow-x: hidden;
        }`
    );

    // Some pages might have a slightly different body regex, let's just do a simpler replace
    if (content.includes('align-items: center;') && content.includes('justify-content: center;') && !content.includes('flex-direction: column;')) {
        content = content.replace('align-items: center;', '');
        content = content.replace('justify-content: center;', 'flex-direction: column;');
    }

    // 3. Include Header
    if (!content.includes("@include('partials.header')")) {
        content = content.replace('<body>', "<body>\n\n    @include('partials.header')\n");
    }

    // 4. Wrap with main and include footer
    if (!content.includes('<main')) {
        content = content.replace('<div class="login-wrapper">', '    <main style="flex: 1; display: flex; align-items: center; justify-content: center; width: 100%; padding: 40px 16px;">\n        <div class="login-wrapper">');
        
        let footerStart = content.indexOf('<!-- Particles JS -->');
        if (footerStart === -1) footerStart = content.indexOf('</body>');

        if (footerStart !== -1) {
            content = content.substring(0, footerStart) + '    </main>\n\n    @include(\'partials.footer\')\n\n    ' + content.substring(footerStart);
        }
    }

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Refactored login pages!");
