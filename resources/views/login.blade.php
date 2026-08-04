<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TEC Login</title>
    <meta name="description" content="Cyberpunk-themed login form with glitch effects, scanline borders and matrix accents.">
    <meta name="author" content="Aigars Silkalns / Colorlib">
    <link rel="canonical" href="https://puikinsh.github.io/login-forms/forms/neon-cyber/">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%236366f1'/><text x='50' y='68' font-size='60' text-anchor='middle' fill='white' font-family='system-ui,sans-serif'>L</text></svg>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="TEC Login Form">
    <meta property="og:description" content="Cyberpunk-themed login form with glitch effects, scanline borders and matrix accents.">
    <meta property="og:url" content="https://puikinsh.github.io/login-forms/forms/neon-cyber/">
    <meta property="og:image" content="https://puikinsh.github.io/login-forms/assets/screenshots/neon-cyber.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="TEC Login Form">
    <meta name="twitter:description" content="Cyberpunk-themed login form with glitch effects, scanline borders and matrix accents.">
    <meta name="twitter:image" content="https://puikinsh.github.io/login-forms/assets/screenshots/neon-cyber.png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="cyber-grid">
        <div class="grid-line grid-h-1"></div>
        <div class="grid-line grid-v-1"></div>
        <div class="grid-line grid-h-2"></div>
        <div class="grid-line grid-v-2"></div>
        <div class="grid-line grid-h-3"></div>
        <div class="cyber-glitch glitch-1"></div>
        <div class="cyber-glitch glitch-2"></div>
    </div>

    <div class="login-container">
        <div class="cyber-terminal">
            <div class="terminal-header">
                <div class="terminal-buttons">
                    <div class="term-btn btn-red"></div>
                    <div class="term-btn btn-yellow"></div>
                    <div class="term-btn btn-green"></div>
                </div>
                <div class="terminal-title">TEC_LOGIN</div>
            </div>
            
            <div class="cyber-content">
                <div class="neon-header">
                    <div class="cyber-logo">
                        <div class="logo-frame">
                            <div class="login-logo">
                        <img src="{{ asset('images/logo/4.png') }}" alt="Logo" class="logo-img">
</div>
                        </div>
                        <div class="neon-glow"></div>
                    </div>
                    <h1 class="cyber-title">
                        <span class="title-glitch" data-text="CYPHER_NET">ITP</span>
                    </h1>
                    <p class="access-text">[ Instituto_Tecnológico_de_Pachuca_(ITP) ]</p>
                </div>
                
                <form class="neon-form" method="POST" action="{{ route('login.post') }}">   
    @csrf
                    <div class="cyber-field">
                        <div class="field-frame">
                            <div class="field-border"></div>
                            <input type="email" id="email" name="email" required autocomplete="email" placeholder=" ">
                            <label for="email">&gt; CORREO ELECTRONICO</label>
                            <div class="cyber-scanner">
                                <div class="scan-line"></div>
                            </div>
                        </div>
                        <span class="cyber-error" id="emailError"></span>
                    </div>

                    <div class="cyber-field">
                        <div class="field-frame">
                            <div class="field-border"></div>
                            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder=" ">
                            <label for="password">&gt; CONTRASEÑA</label>
                            <button type="button" class="cyber-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                                <div class="toggle-frame">
                                    <svg class="eye-scan" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M9 3c-4 0-7 3-8 6 1 3 4 6 8 6s7-3 8-6c-1-3-4-6-8-6zm0 10a4 4 0 110-8 4 4 0 010 8zm0-6a2 2 0 100 4 2 2 0 000-4z" fill="currentColor"/>
                                    </svg>
                                    <svg class="eye-blocked" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M3 3l12 12M7 7a3 3 0 003 3m3-3C13 7 10 4 9 4c-1 0-3 1-4 2M9 14c4 0 7-3 8-6-1-1-2-2-3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </button>
                            <div class="cyber-scanner">
                                <div class="scan-line"></div>
                            </div>
                        </div>
                        <span class="cyber-error" id="passwordError"></span>
                    </div>

                    <div class="cyber-options">
                        <label class="neon-checkbox">
                            <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkbox-matrix">
                                <div class="matrix-frame"></div>
                                <svg width="10" height="8" viewBox="0 0 10 8" fill="none">
                                    <path d="M1 4l2.5 2.5L9 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="checkbox-text">MANTENER_LA_SESION</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="cyber-link">
                        RECUPERAR_ACCESO
                        </a>
                    </div>

                    <button type="submit" class="neon-button">
                        <div class="btn-matrix"></div>
                        <span class="btn-text">[ INICIAR SESION ]</span>
                        <div class="btn-loader">
                            <div class="matrix-loader">
                                <div class="matrix-bar"></div>
                                <div class="matrix-bar"></div>
                                <div class="matrix-bar"></div>
                                <div class="matrix-bar"></div>
                            </div>
                        </div>
                        <div class="btn-glow"></div>
                    </button>
                </form>

                <div class="cyber-divider">
                    <div class="divider-grid"></div>
                    <span class="divider-text">[ OTROS METODOS DE INICIO ]</span>
                    <div class="divider-grid"></div>
                </div>

                <div class="matrix-social">

    <a href="{{ route('google.login') }}" class="social-matrix">

    <div class="social-frame"></div>

    <svg width="18" height="18" viewBox="0 0 48 48">
        <path fill="#EA4335" d="M24 9.5c3.54 0 6.72 1.22 9.22 3.6l6.9-6.9C35.9 2.4 30.4 0 24 0 14.6 0 6.4 5.4 2.4 13.3l8 6.2C12.2 13.4 17.6 9.5 24 9.5z"/>
        <path fill="#4285F4" d="M46.1 24.5c0-1.6-.14-3.1-.4-4.5H24v9h12.5c-.54 2.9-2.18 5.3-4.64 6.9l7.2 5.6c4.2-3.9 6.99-9.7 6.99-17z"/>
        <path fill="#FBBC05" d="M10.4 28.5A14.4 14.4 0 019.5 24c0-1.57.3-3.08.9-4.5l-8-6.2A24 24 0 000 24c0 3.9.94 7.58 2.6 10.8l7.8-6.3z"/>
        <path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.2-5.6c-2 1.3-4.6 2.1-8.7 2.1-6.4 0-11.8-3.9-13.7-9.4l-7.8 6.3C6.4 42.6 14.6 48 24 48z"/>
    </svg>

    <span>GOOGLE_LOGIN</span>

    <div class="social-glow"></div>

</a>

</div>
                <div class="matrix-signup">
                    <span class="signup-prefix">[ NUEVO_USUARIO ]</span>
                    <a href="{{ route('register') }}" class="matrix-link">
                    CREAR PERFIL
                    </a>
                </div>

                <div class="cyber-success" id="successMessage">
                    <div class="success-matrix">
                        <div class="matrix-rings">
                            <div class="success-ring ring-1"></div>
                            <div class="success-ring ring-2"></div>
                            <div class="success-ring ring-3"></div>
                        </div>
                        <div class="success-core">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M10 16l6 6 12-12" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="success-title">[ CONECCION_ESTABLECIDA ]</h3>
                    <p class="success-desc">Acceso a la interface...</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/form-utils.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>