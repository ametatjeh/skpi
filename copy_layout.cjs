const fs = require('fs');

let welcome = fs.readFileSync('c:/XPROJECT/x6/resources/views/welcome.blade.php', 'utf8');
let register = fs.readFileSync('c:/XPROJECT/x6/resources/views/auth/register-email.blade.php', 'utf8');

// 1. Extract CSS
let cssStart = welcome.indexOf('/* ======= NAVBAR BLUE ======= */');
let cssEnd = welcome.indexOf('/* ======= HERO ======= */');
if (cssEnd === -1) cssEnd = welcome.indexOf('.hero {');
let navCss = welcome.substring(cssStart, cssEnd);

// 2. Extract Navbar HTML
let navStart = welcome.indexOf('<!-- NAVBAR BLUE -->');
let navEnd = welcome.indexOf('<!-- HERO + CARDS KANAN -->');
let navHtml = welcome.substring(navStart, navEnd);

// 3. Extract Footer HTML
let footerStart = welcome.indexOf('<!-- FOOTER INFO -->');
let footerEnd = welcome.indexOf('</body>');
let footerHtml = welcome.substring(footerStart, footerEnd);

// Now inject into register
// Inject CSS before </style>
register = register.replace('</style>', navCss + '\n</style>');

// Change body layout
register = register.replace(
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

// Inject Navbar and wrap main
let blobEnd = register.indexOf('<div class="main-container">');
if (blobEnd !== -1) {
    register = register.substring(0, blobEnd) + navHtml + '\n    <main style="flex: 1; display: flex; align-items: center; justify-content: center; width: 100%; padding: 40px 16px;">\n    ' + register.substring(blobEnd);
}

// Close main and inject footer
let modalStart = register.indexOf('<!-- SUCCESS MODAL -->');
if (modalStart !== -1) {
    register = register.substring(0, modalStart) + '    </main>\n\n    ' + footerHtml + '\n    ' + register.substring(modalStart);
}

fs.writeFileSync('c:/XPROJECT/x6/resources/views/auth/register-email.blade.php', register, 'utf8');
console.log("Done");
