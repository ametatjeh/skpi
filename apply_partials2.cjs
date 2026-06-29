const fs = require('fs');

const files = [
    'c:/XPROJECT/x6/resources/views/skema.blade.php',
    'c:/XPROJECT/x6/resources/views/capaian.blade.php'
];

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');

    // 2. Replace Header HTML
    let navStart = content.indexOf('<!-- NAVBAR BLUE -->');
    if (navStart !== -1) {
        let navEnd = content.indexOf('<!-- CONTENT SECTION -->', navStart);
        if (navEnd === -1) navEnd = content.indexOf('<!-- KONTEN UTAMA -->', navStart);
        if (navEnd === -1) navEnd = content.indexOf('<section', navStart);
        
        if (navEnd !== -1) {
            content = content.substring(0, navStart) + "@include('partials.header')\n    " + content.substring(navEnd);
        }
    }

    // 3. Replace Footer HTML & Script
    let footerStart = content.indexOf('<!-- FOOTER INFO -->');
    if (footerStart === -1) footerStart = content.indexOf('<!-- FOOTER -->');
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

console.log("Refactoring applied for skema and capaian!");
