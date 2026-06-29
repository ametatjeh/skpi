const fs = require('fs');

let file = 'c:/XPROJECT/x6/resources/views/auth/register-email.blade.php';
let content = fs.readFileSync(file, 'utf8');

// Include styles
if (!content.includes("@include('partials.styles')")) {
    content = content.replace('</style>', "    @include('partials.styles')\n</style>");
}

// Modify body
if (!content.includes('flex-direction: column')) {
    content = content.replace(
`        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 16px;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #fff;
            position: relative;
            overflow-x: hidden;
        }`,
`        body {
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
}

// Include Header
if (!content.includes("@include('partials.header')")) {
    content = content.replace('<body>', "<body>\n\n    @include('partials.header')\n");
}

// Wrap in <main>
if (!content.includes('<main')) {
    content = content.replace('<div class="main-container">', '    <main style="flex: 1; display: flex; align-items: center; justify-content: center; width: 100%; padding: 40px 16px;">\n        <div class="main-container">');
    let modalStart = content.indexOf('<!-- SUCCESS MODAL -->');
    if (modalStart !== -1) {
        content = content.substring(0, modalStart) + '    </main>\n\n    @include(\'partials.footer\')\n\n    ' + content.substring(modalStart);
    }
}

fs.writeFileSync(file, content, 'utf8');
console.log("Updated register-email.blade.php (v2)");
