const fs = require('fs');

const files = [
    'resources/views/auth/login-mahasiswa.blade.php',
    'resources/views/auth/login-prodi.blade.php',
    'resources/views/auth/login-pusat-bahasa.blade.php',
    'resources/views/auth/login-fakultas.blade.php',
    'resources/views/auth/login-admin.blade.php'
];

const wrapper_css = `.login-wrapper {
            width: 100%;
            max-width: 480px;
            min-height: 520px;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }`;

const form_side_css = `.form-side {
            padding: 40px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: transparent;
            color: #f8fafc;
        }`;

const input_css = `.form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            font-size: .95rem;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #60a5fa;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.25);
        }`;

const btn_css = `.btn {
            width: 100%;
            padding: 11px 0;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .2);
            transition: .2s;
        }

        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .3);
        }`;

files.forEach(fpath => {
    try {
        let content = fs.readFileSync(fpath, 'utf-8');
        
        content = content.replace(/\.login-wrapper\s*\{[^}]+\}/, wrapper_css);
        content = content.replace(/\.form-side\s*\{[^}]+\}/, form_side_css);
        content = content.replace(/\.form-group input\s*\{[^}]+\}\s*\.form-group input:focus\s*\{[^}]+\}/, input_css);
        content = content.replace(/\.btn\s*\{[^}]+\}\s*\.btn:hover\s*\{[^}]+\}/, btn_css);
        
        content = content.replace(/color:\s*#0d47a1;/g, 'color: #ffffff;'); // general h2 and icons
        content = content.replace(/color:\s*#6b7280;/g, 'color: #cbd5e1;'); // p
        content = content.replace(/color:\s*#111827;/g, 'color: #e2e8f0;'); // labels
        content = content.replace(/color:\s*#0050a0;/g, 'color: #60a5fa;'); // links
        
        // Inline icon colors fix (for inline styles)
        content = content.replace(/color:\s*#ffffff;\s*margin-bottom:/g, 'color: #60a5fa; margin-bottom:');
        // Because the first replace might change the #0d47a1 to #ffffff in inline styles. Wait, the first one replaces '#0d47a1;'.
        // So the inline icon style "color: #0d47a1; margin-bottom" became "color: #ffffff; margin-bottom". Let's change it to #60a5fa.
        
        // Let's also fix the `.login-header h2 i`
        content = content.replace(/\.login-header h2 i\s*\{\s*color:\s*#ffffff;\s*\}/, '.login-header h2 i { color: #60a5fa; }');

        // Form group label might not have been caught if it didn't end with a semicolon in regex but simple replace will catch it
        
        fs.writeFileSync(fpath, content, 'utf-8');
        console.log(`Updated ${fpath}`);
    } catch (e) {
        console.error(`Failed ${fpath}: ${e}`);
    }
});
