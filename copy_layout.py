import re

with open('c:/XPROJECT/x6/resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    welcome = f.read()

with open('c:/XPROJECT/x6/resources/views/auth/register-email.blade.php', 'r', encoding='utf-8') as f:
    register = f.read()

# 1. Extract CSS
# from /* ======= NAVBAR BLUE ======= */ to /* ======= HERO ======= */
css_match = re.search(r'(/\* ======= NAVBAR BLUE ======= \*/.*?)/\* ======= HERO ======= \*/', welcome, re.DOTALL)
if css_match:
    nav_css = css_match.group(1)
else:
    nav_css = ""

# Wait, in welcome.blade.php, is it /* ======= HERO ======= */? Let's use a more flexible regex.
css_start = welcome.find('/* ======= NAVBAR BLUE ======= */')
css_end = welcome.find('/* ======= HERO ======= */')
if css_end == -1:
    css_end = welcome.find('.hero {')
nav_css = welcome[css_start:css_end]

# 2. Extract Navbar HTML
nav_start = welcome.find('<!-- NAVBAR BLUE -->')
nav_end = welcome.find('<!-- HERO + CARDS KANAN -->')
nav_html = welcome[nav_start:nav_end]

# 3. Extract Footer HTML
footer_start = welcome.find('<!-- FOOTER INFO -->')
footer_end = welcome.find('</body>')
footer_html = welcome[footer_start:footer_end]

# Now inject into register
# Inject CSS before </style>
register = register.replace('</style>', nav_css + '\n</style>')

# Change body layout
register = register.replace('''        body {
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
        }''', '''        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #fff;
            position: relative;
            overflow-x: hidden;
        }''')

# Wrap .main-container in <main>
# Inject Navbar after <body>
# We'll find <div class="main-container"> and wrap it.
body_start = register.find('<body>')
# Wait, there are particles inside body.
# Let's inject nav_html after decorative blobs.
blob_end = register.find('<div class="main-container">')
if blob_end != -1:
    register = register[:blob_end] + nav_html + '\n    <main style="flex: 1; display: flex; align-items: center; justify-content: center; width: 100%; padding: 40px 16px;">\n    ' + register[blob_end:]
    
# Now close <main> before modal or before scripts
modal_start = register.find('<!-- SUCCESS MODAL -->')
if modal_start != -1:
    register = register[:modal_start] + '    </main>\n\n    ' + footer_html + '\n    ' + register[modal_start:]
    
with open('c:/XPROJECT/x6/resources/views/auth/register-email.blade.php', 'w', encoding='utf-8') as f:
    f.write(register)

print("Done")
