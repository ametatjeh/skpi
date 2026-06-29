const fs = require('fs');

const files = [
    'c:/XPROJECT/x6/resources/views/welcome.blade.php',
    'c:/XPROJECT/x6/resources/views/skema.blade.php',
    'c:/XPROJECT/x6/resources/views/capaian.blade.php',
    'c:/XPROJECT/x6/resources/views/auth/register-email.blade.php'
];

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');

    // 1. Replace CSS
    let cssStart = content.indexOf('/* ======= TOP SOCIAL BAR ======= */');
    if (cssStart === -1) cssStart = content.indexOf('/* ======= NAVBAR BLUE ======= */');
    
    let cssEnd = content.indexOf('/* ======= HERO ======= */');
    if (cssEnd === -1) cssEnd = content.indexOf('/* ======= CARDS DI SAMPING KANAN ======= */');
    if (cssEnd === -1) cssEnd = content.indexOf('/* ========= FOOTER ========= */');
    if (cssEnd === -1) cssEnd = content.indexOf('/* ========= KONTEN UTAMA ========= */');

    let responsiveStart = content.indexOf('/* ========= RESPONSIVE ========= */');
    let responsiveEnd = content.indexOf('</style>', responsiveStart);

    if (cssStart !== -1) {
        if (responsiveStart !== -1 && responsiveStart > cssStart) {
            // Remove both blocks
            let firstPart = content.substring(0, cssStart);
            let middlePart = content.substring(cssEnd !== -1 ? cssEnd : responsiveStart, responsiveStart);
            let lastPart = content.substring(responsiveEnd);
            content = firstPart + "@include('partials.styles')\n        " + middlePart + lastPart;
        } else {
            let lastPart = content.substring(cssEnd !== -1 ? cssEnd : content.indexOf('</style>'));
            content = content.substring(0, cssStart) + "@include('partials.styles')\n        " + lastPart;
        }
    }

    // For register-email which doesn't have the comments but exact css block, 
    // actually register-email css was added by my script, so I can just replace navCss with @include.
    // wait, register-email didn't have comments? My script injected `navCss` before `</style>`. Let's handle it manually or just use regex.

    // 2. Replace Header HTML
    let navStart = content.indexOf('<!-- NAVBAR BLUE -->');
    let navEnd = content.indexOf('<!-- HERO + CARDS KANAN -->');
    if (navEnd === -1) navEnd = content.indexOf('<!-- HEADER TITLE -->');
    if (navEnd === -1) navEnd = content.indexOf('<!-- HERO -->');
    if (navEnd === -1) navEnd = content.indexOf('<!-- HERO / HEADER -->');
    if (navEnd === -1) navEnd = content.indexOf('<main'); // register-email has this

    if (navStart !== -1 && navEnd !== -1) {
        content = content.substring(0, navStart) + "@include('partials.header')\n    " + content.substring(navEnd);
    }

    // 3. Replace Footer HTML & Script
    let footerStart = content.indexOf('<!-- FOOTER INFO -->');
    if (footerStart !== -1) {
        let footerEnd = content.indexOf('<!-- SUCCESS MODAL -->', footerStart);
        if (footerEnd === -1) footerEnd = content.indexOf('<!-- Particles JS -->', footerStart);
        if (footerEnd === -1) footerEnd = content.indexOf('</body>', footerStart);

        if (footerEnd !== -1) {
            content = content.substring(0, footerStart) + "@include('partials.footer')\n    " + content.substring(footerEnd);
        }
    }

    fs.writeFileSync(file, content, 'utf8');
});

console.log("Refactoring applied!");
