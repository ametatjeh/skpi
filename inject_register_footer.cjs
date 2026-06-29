const fs = require('fs');

let file = 'c:/XPROJECT/x6/resources/views/auth/register-email.blade.php';
let content = fs.readFileSync(file, 'utf8');

if (!content.includes("@include('partials.footer')")) {
    let footerTarget = content.indexOf('<!-- Particles JS -->');
    if (footerTarget !== -1) {
        content = content.substring(0, footerTarget) + '@include(\'partials.footer\')\n\n    ' + content.substring(footerTarget);
        fs.writeFileSync(file, content, 'utf8');
        console.log("Injected footer into register-email.blade.php");
    }
} else {
    console.log("Already has footer");
}
