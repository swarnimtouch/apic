<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:      #0a0f1e;
            --surface: #111827;
            --border:  #1f2f4a;
            --accent:  #00d4ff;
            --accent2: #7c3aed;
            --text:    #e2e8f0;
            --muted:   #64748b;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 20px 16px;
        }
        .blob { position:absolute; border-radius:50%; filter:blur(90px); opacity:.14; animation:float 8s ease-in-out infinite; pointer-events:none; }
        .blob-1 { width:440px; height:440px; background:var(--accent); top:-120px; right:-80px; }
        .blob-2 { width:360px; height:360px; background:var(--accent2); bottom:-90px; left:-70px; animation-delay:-4s; }
        @keyframes float { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(18px,-18px) scale(1.04)} }
        body::before {
            content:''; position:absolute; inset:0;
            background-image: linear-gradient(rgba(0,212,255,.025) 1px,transparent 1px), linear-gradient(90deg,rgba(0,212,255,.025) 1px,transparent 1px);
            background-size:50px 50px; pointer-events:none;
        }
        .login-card {
            background:var(--surface); border:1px solid var(--border); border-radius:24px;
            padding:44px 40px 36px; width:100%; max-width:420px;
            position:relative; z-index:1; animation:slideUp .45s ease;
        }
        @keyframes slideUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .login-card::before {
            content:''; position:absolute; top:0; left:32px; right:32px; height:2px;
            background:linear-gradient(90deg,var(--accent),var(--accent2)); border-radius:0 0 4px 4px;
        }
        .card-header { text-align:center; margin-bottom:32px; }
        .logo-icon-wrap {
            width:70px; height:70px; margin:0 auto 16px; border-radius:18px;
            background:linear-gradient(135deg,var(--accent),var(--accent2));
            display:flex; align-items:center; justify-content:center;
            box-shadow:0 8px 32px rgba(0,212,255,.22); overflow:hidden; position:relative;
        }
        .logo-icon-wrap img.logo-img { width:100%; height:100%; object-fit:cover; display:block; position:relative; z-index:2; }
        .logo-icon-wrap .logo-emoji { font-size:30px; position:absolute; z-index:1; }
        .brand-name-wrap { display:flex; align-items:center; justify-content:center; margin-bottom:6px; }
        .brand-name-wrap img.brand-img { max-height:38px; max-width:200px; object-fit:contain; }
        .brand-text {
            font-family:'Syne',sans-serif; font-size:24px; font-weight:800;
            background:linear-gradient(90deg,var(--accent),var(--accent2));
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
        }
        .card-sub { color:var(--muted); font-size:13px; margin-top:4px; }
        .form-group { margin-bottom:18px; }
        label { display:block; font-size:11px; font-weight:700; color:var(--muted); letter-spacing:.07em; text-transform:uppercase; margin-bottom:7px; }
        .input-wrap { position:relative; }
        .inp-icon { position:absolute; left:13px; top:50%; transform:translateY(-50%); font-size:15px; pointer-events:none; line-height:1; }
        input[type="email"], input[type="password"], input[type="text"] {
            width:100%; background:#0d1526; border:1px solid var(--border); border-radius:12px;
            padding:13px 44px 13px 42px; color:var(--text); font-family:'DM Sans',sans-serif;
            font-size:15px; transition:border-color .2s,box-shadow .2s; outline:none; -webkit-appearance:none;
        }
        input[type="email"]:focus, input[type="password"]:focus, input[type="text"]:focus {
            border-color:var(--accent); box-shadow:0 0 0 3px rgba(0,212,255,.1);
        }
        input::placeholder { color:var(--muted); opacity:1; }
        .toggle-pass {
            position:absolute; right:12px; top:50%; transform:translateY(-50%);
            background:none; border:none; color:var(--muted); cursor:pointer; font-size:16px; padding:4px; line-height:1;
        }
        .toggle-pass:hover { color:var(--text); }
        .error-msg { font-size:12px; color:#ff4d6d; margin-top:5px; }
        .alert-error {
            background:rgba(255,77,109,.08); border:1px solid rgba(255,77,109,.22);
            color:#ff4d6d; padding:11px 14px; border-radius:10px; font-size:13px; margin-bottom:18px;
        }
        .submit-btn {
            width:100%; padding:14px; margin-top:6px;
            background:linear-gradient(135deg,var(--accent),var(--accent2));
            border:none; border-radius:12px; color:#fff;
            font-family:'Syne',sans-serif; font-size:15px; font-weight:700;
            cursor:pointer; letter-spacing:.04em; transition:all .2s;
            box-shadow:0 4px 20px rgba(0,212,255,.18); -webkit-appearance:none;
        }
        .submit-btn:hover  { transform:translateY(-1px); box-shadow:0 8px 28px rgba(0,212,255,.3); }
        .submit-btn:active { transform:translateY(0); }
        .card-footer { text-align:center; margin-top:22px; color:var(--muted); font-size:12px; }

        @media (max-width:480px) {
            .login-card  { padding:30px 20px 26px; border-radius:20px; }
            .logo-icon-wrap { width:58px; height:58px; border-radius:14px; }
            .logo-icon-wrap .logo-emoji { font-size:24px; }
            .brand-text  { font-size:20px; }
            input[type="email"], input[type="password"], input[type="text"] { font-size:16px; }
            .submit-btn  { font-size:15px; padding:13px; }
        }
        @media (max-width:360px) {
            body { padding:10px; }
            .login-card { padding:24px 14px 20px; }
            .brand-text { font-size:18px; }
        }
        @supports (padding-bottom:env(safe-area-inset-bottom)) {
            body { padding-bottom:calc(20px + env(safe-area-inset-bottom)); }
        }
    </style>
</head>
<body>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div class="login-card">
    <div class="card-header">
        {{-- ✅ Icon Logo: public/images/logo.png rakho --}}
        <div class="logo-icon-wrap">
            <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
        </div>

        {{-- ✅ Brand name: public/images/brand.png rakho. Nahi mila toh text dikhega --}}
        <div class="brand-name-wrap">
            <img class="brand-img" src="{{ asset('images/brand.png') }}" alt="Brand"
                 onerror="this.style.display='none'; document.getElementById('brandText').style.display='block';">
            <span class="brand-text" id="brandText" style="display:none;">Admin Panel</span>
        </div>

        <p class="card-sub">Sign in to your admin account</p>
    </div>

    @if($errors->any())
        <div class="alert-error">❌ {{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/admin/login">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <div class="input-wrap">
                <span class="inp-icon">📧</span>
                <input type="email" name="email" placeholder="admin@example.com"
                       value="{{ old('email') }}" autocomplete="email" required/>
            </div>
            @error('email')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-wrap">
                <span class="inp-icon">🔑</span>
                <input type="password" name="password" id="passInp"
                       placeholder="••••••••" autocomplete="current-password" required/>
                <button type="button" class="toggle-pass" id="toggleBtn" onclick="togglePass()">👁</button>
            </div>
            @error('password')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="submit-btn">Sign In →</button>
    </form>

    <div class="card-footer">🔒 Secure Admin Access Only</div>
</div>

<script>
    function togglePass() {
        const inp = document.getElementById('passInp');
        const btn = document.getElementById('toggleBtn');
        inp.type = inp.type === 'password' ? 'text' : 'password';
        btn.textContent = inp.type === 'password' ? '👁' : '🙈';
    }
</script>
</body>
</html>
