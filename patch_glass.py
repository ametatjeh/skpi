import re
import glob

files = [
    'resources/views/auth/login-mahasiswa.blade.php',
    'resources/views/auth/login-prodi.blade.php',
    'resources/views/auth/login-pusat-bahasa.blade.php',
    'resources/views/auth/login-fakultas.blade.php',
    'resources/views/auth/login-admin.blade.php'
]

wrapper_css = """.login-wrapper {
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
        }"""

form_side_css = """.form-side {
            padding: 40px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: transparent;
            color: #f8fafc;
        }"""

input_css = """.form-group input {
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
        }"""

btn_css = """.btn {
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
        }"""

for fpath in files:
    try:
        with open(fpath, 'r', encoding='utf-8') as f:
            content = f.read()
            
        # Replace .login-wrapper block
        content = re.sub(r'\.login-wrapper\s*\{[^}]+\}', wrapper_css, content)
        
        # Replace .form-side block
        content = re.sub(r'\.form-side\s*\{[^}]+\}', form_side_css, content)
        
        # Replace .form-group input and focus blocks
        content = re.sub(r'\.form-group input\s*\{[^}]+\}\s*\.form-group input:focus\s*\{[^}]+\}', input_css, content)
        
        # Replace .btn and .btn:hover
        content = re.sub(r'\.btn\s*\{[^}]+\}\s*\.btn:hover\s*\{[^}]+\}', btn_css, content)
        
        # Replace specific colors
        content = content.replace('color: #0d47a1;', 'color: #ffffff;') # h2
        content = content.replace('color: #6b7280;', 'color: #cbd5e1;') # p
        content = content.replace('color: #111827;', 'color: #e2e8f0;') # labels
        content = content.replace('color: #0050a0;', 'color: #60a5fa;') # links
        
        # Inline icon colors
        content = content.replace('color: #0d47a1; margin-bottom', 'color: #60a5fa; margin-bottom')
        
        # Write back
        with open(fpath, 'w', encoding='utf-8') as f:
            f.write(content)
            
        print(f"Updated {fpath}")
    except Exception as e:
        print(f"Failed {fpath}: {e}")
