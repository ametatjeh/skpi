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

    // 1. Find the blobs and particles block
    let blobStart = content.indexOf('<!-- Particles container -->');
    let mainStart = content.indexOf('<main style="flex: 1;');

    if (blobStart !== -1 && mainStart !== -1 && blobStart < mainStart) {
        // Extract the blobs
        let blobs = content.substring(blobStart, mainStart);
        
        // Remove blobs from the original position
        content = content.substring(0, blobStart) + content.substring(mainStart);
        
        // Find the new <main> position
        mainStart = content.indexOf('<main style="flex: 1;');
        let mainEnd = content.indexOf('>', mainStart) + 1;
        
        // Add overflow: hidden; position: relative; if not there
        let mainTag = content.substring(mainStart, mainEnd);
        if (!mainTag.includes('overflow: hidden;')) {
            mainTag = mainTag.replace('style="', 'style="overflow: hidden; position: relative; ');
            content = content.substring(0, mainStart) + mainTag + '\n' + blobs + content.substring(mainEnd);
        }
    } else {
        // Just ensure <main> has overflow hidden
        let mStart = content.indexOf('<main style="flex: 1;');
        if (mStart !== -1) {
            let mEnd = content.indexOf('>', mStart) + 1;
            let mTag = content.substring(mStart, mEnd);
            if (!mTag.includes('overflow: hidden;')) {
                mTag = mTag.replace('style="', 'style="overflow: hidden; position: relative; ');
                content = content.substring(0, mStart) + mTag + content.substring(mEnd);
            }
        }
    }

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Moved blobs and added overflow: hidden to main!");
