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

    // 1. Remove duplicate footers
    content = content.replace(/(<\/main>\s*@include\('partials\.footer'\)\s*)+/g, "</main>\n\n    @include('partials.footer')\n\n    ");

    // 2. Ensure Particles JS script exists (login-mahasiswa didn't have the comment, some did)
    // Actually the duplicate was caused by my script matching <script> and finding it multiple times or something.
    // Let's just do a clean replace to ensure exactly one footer and exactly one closing main.
    
    // Remove all </main> and @include('partials.footer')
    content = content.replace(/<\/main>/g, '');
    content = content.replace(/@include\('partials\.footer'\)/g, '');

    // Re-inject right before <!-- Particles JS --> or <script src="https://cdn.jsdelivr.net/npm/particles.js
    let footerTarget = content.indexOf('<!-- Particles JS -->');
    if (footerTarget === -1) footerTarget = content.indexOf('<script src="https://cdn.jsdelivr.net/npm/particles.js');
    if (footerTarget === -1) footerTarget = content.indexOf('</body>');

    if (footerTarget !== -1) {
        content = content.substring(0, footerTarget) + '    </main>\n\n    @include(\'partials.footer\')\n\n    ' + content.substring(footerTarget);
    }

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Cleaned up login pages!");
