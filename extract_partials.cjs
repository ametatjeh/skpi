const fs = require('fs');

const welcome = fs.readFileSync('c:/XPROJECT/x6/resources/views/welcome.blade.php', 'utf8');

// 1. Extract CSS
let cssStart = welcome.indexOf('/* ======= TOP SOCIAL BAR ======= */');
let cssEnd = welcome.indexOf('/* ======= HERO ======= */');
if (cssEnd === -1) cssEnd = welcome.indexOf('/* ======= CARDS DI SAMPING KANAN ======= */');

// We also need the RESPONSIVE css block
let responsiveStart = welcome.indexOf('/* ========= RESPONSIVE ========= */');
let responsiveEnd = welcome.indexOf('</style>');

let cssContent = welcome.substring(cssStart, cssEnd) + "\n" + welcome.substring(responsiveStart, responsiveEnd);
// Let's filter out hero specific responsive stuff if any, or leave it.

let stylesContent = `<style>\n${cssContent}</style>`;
fs.writeFileSync('c:/XPROJECT/x6/resources/views/partials/styles.blade.php', stylesContent, 'utf8');

// 2. Extract Navbar HTML
let navStart = welcome.indexOf('<!-- NAVBAR BLUE -->');
let navEnd = welcome.indexOf('<!-- HERO + CARDS KANAN -->');
let navHtml = welcome.substring(navStart, navEnd);
fs.writeFileSync('c:/XPROJECT/x6/resources/views/partials/header.blade.php', navHtml, 'utf8');

// 3. Extract Footer HTML
let footerStart = welcome.indexOf('<!-- FOOTER INFO -->');
// Wait, we need to make sure we don't grab the mobile nav script if it's there.
let footerEnd = welcome.indexOf('<script>', footerStart);
if (footerEnd === -1 || footerEnd - footerStart > 2000) {
    footerEnd = welcome.indexOf('</body>', footerStart);
}
let footerHtml = welcome.substring(footerStart, footerEnd);

// Also extract the script for mobile nav toggle
let scriptStart = welcome.indexOf('<script>', footerEnd);
let scriptEnd = welcome.indexOf('<!-- Particles JS -->', scriptStart);
if (scriptEnd === -1) {
    scriptEnd = welcome.indexOf('</body>', scriptStart);
}
let scriptHtml = welcome.substring(scriptStart, scriptEnd);

fs.writeFileSync('c:/XPROJECT/x6/resources/views/partials/footer.blade.php', footerHtml + '\n' + scriptHtml, 'utf8');

console.log("Partials created!");
