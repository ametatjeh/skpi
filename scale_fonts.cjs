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

    // 1. Scale the icons (font-size: 4rem to clamp)
    content = content.replace(
        /font-size:\s*4rem;/g, 
        'font-size: clamp(2.5rem, 8vh, 4rem);'
    );
    
    // 2. Scale the margin on the icons
    content = content.replace(
        /margin-bottom:\s*15px;/g, 
        'margin-bottom: clamp(5px, 2vh, 15px);'
    );

    // 3. For login pages, scale .login-header h2
    if (content.includes('.login-header h2')) {
        content = content.replace(
            /font-size:\s*1\.6rem;/g,
            'font-size: clamp(1.2rem, 4vh, 1.6rem);'
        );
        content = content.replace(
            /margin-bottom:\s*4px;/g,
            'margin-bottom: clamp(2px, 1vh, 4px);'
        );
    }

    // 4. For register-email.blade.php, scale the inline h2
    if (file.includes('register-email.blade.php')) {
        content = content.replace(
            /<h2 style="justify-content: center;">PORTAL PENDAFTARAN<\/h2>/g,
            '<h2 style="justify-content: center; font-size: clamp(1.3rem, 4vh, 1.8rem); margin-bottom: clamp(5px, 2vh, 15px);">PORTAL PENDAFTARAN</h2>'
        );
    }

    // 5. Also, let's scale the wrapper padding just to be perfectly responsive
    // <main style="... padding: 40px 16px;">
    content = content.replace(
        /padding:\s*40px\s*16px;/g,
        'padding: clamp(10px, 3vh, 40px) 16px;'
    );
    
    // 6. And the wrapper min-height if they used 520px
    content = content.replace(
        /min-height:\s*520px;/g,
        'min-height: clamp(380px, 60vh, 520px);'
    );

    // 7. Form-side padding inside the box
    content = content.replace(
        /padding:\s*40px\s*46px;/g,
        'padding: clamp(20px, 4vh, 40px) clamp(20px, 4vw, 46px);'
    );

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Applied clamp() scaling to fonts, icons, margins, and paddings for all auth pages!");
