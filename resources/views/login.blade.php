
    <!-- Google Fonts: Inter, una fuente limpia y profesional -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons: Remixicon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        /* --- 1. Definición de la Paleta de Colores (Personalizable) --- */
        :root {
            --theme-primary: #6366F1;
            --theme-primary-hover: #4F46E5;
            --theme-primary-light: #EEF2FF; /* Modificado para ser un poco más visible */
            --theme-primary-dark: #3730A3;
            --theme-primary-text-on-light: #4338CA;
            --theme-accent: #14B8A6;
            --theme-accent-hover: #0D9488;
            --theme-accent-light: #F0FDFA;

            --color-background: #F8F9FA;
            --color-surface: #FFFFFF;
            --color-text-primary: #1F2937;
            --color-text-secondary: #6B7280;
            --color-border: #D1D5DB;
            --color-error: #EF4444;
        }

        /* --- 2. Reset y Estilos Base --- */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-background);
            color: var(--color-text-primary);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* --- 3. Maquetación Principal (Split Screen) --- */
        .auth-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* --- Columna Izquierda: Ilustración y Marca --- */
        .auth-illustration-side {
            background-color: var(--theme-primary-light);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px;
            animation: fadeIn 1s ease-out;
        }

        .illustration-content {
            text-align: center;
            color: var(--theme-primary-text-on-light);
        }

        .illustration-content img {
            max-width: 80%;
            height: auto;
            margin-bottom: 32px;
        }

        .illustration-content h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .illustration-content p {
            font-size: 1rem;
            max-width: 400px;
            margin: 0 auto;
            opacity: 0.8;
        }

        /* --- Columna Derecha: Formulario --- */
        .auth-form-side {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
            animation: slideUpFadeIn 0.8s ease-out forwards;
        }
        
        .login-header {
            margin-bottom: 32px;
        }
        
        .login-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-header p {
            color: var(--color-text-secondary);
        }

        /* --- Estilos del Formulario --- */
        .input-group {
            margin-bottom: 20px;
        }
        
        .input-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }
        
        .input-field {
            width: 100%;
            height: 48px;
            padding: 0 16px 0 44px; /* Espacio para el icono */
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: var(--theme-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-secondary);
            font-size: 1.25rem;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--color-text-secondary);
            padding: 4px;
        }

        /* --- Estados de Error --- */
        .input-field.is-invalid {
            border-color: var(--color-error);
        }
        .input-field.is-invalid:focus {
             box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }
        .error-message {
            color: var(--color-error);
            font-size: 0.8rem;
            display: block;
            margin-top: 6px;
            height: 15px; /* Evita saltos de layout */
        }
        
        /* --- Opciones del Formulario --- */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            cursor: pointer;
        }
        
        .remember-me input {
            margin-right: 8px;
            accent-color: var(--theme-primary);
        }
        
        .forgot-password {
            font-size: 0.875rem;
            color: var(--theme-accent);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .forgot-password:hover {
            color: var(--theme-accent-hover);
            text-decoration: underline;
        }
        
        /* --- Botón Principal --- */
        .login-button {
            width: 100%;
            height: 48px;
            background-color: var(--theme-primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }
        
        .login-button:hover:not(:disabled) {
            background-color: var(--theme-primary-hover);
        }
        .login-button:active:not(:disabled) {
            transform: scale(0.98);
        }
        .login-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* --- Spinner para el botón --- */
        .spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 12px;
        }

        /* --- Animaciones --- */
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUpFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Responsividad --- */
        @media (max-width: 992px) {
            .auth-container {
                grid-template-columns: 1fr;
            }
            .auth-illustration-side {
                display: none; /* Ocultamos la ilustración en pantallas pequeñas */
            }
        }

    </style>

    <div class="auth-container">
        <!-- Columna Izquierda: Ilustración -->
        <div class="auth-illustration-side">
            <div class="illustration-content">
                <!-- REEMPLAZA ESTE SVG con una ilustración de tu elección -->
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/login-3305943-2757111.png" alt="Ilustración de seguridad">
                <h1>Gestiona tu Éxito</h1>
                <p>Una plataforma centralizada para llevar tu productividad al siguiente nivel.</p>
            </div>
        </div>

        <!-- Columna Derecha: Formulario -->
        <div class="auth-form-side">
            <div class="login-card">
                <div class="login-header">
                    <h2>Iniciar Sesión</h2>
                    <p>¡Bienvenido de nuevo! Por favor, ingresa tus datos.</p>
                </div>

                <form id="formAuthentication" action="{{ route('login.attempt') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="input-group">
                        <label for="email" class="input-label">Email</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" class="input-field" placeholder="tu@email.com" required>
                            <i class="ri-mail-line"></i>
                        </div>
                        <span class="error-message" id="email-error"></span>
                    </div>

                    <div class="input-group">
                        <label for="password" class="input-label">Contraseña</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="input-field" placeholder="••••••••" required>
                            <i class="ri-lock-line"></i>
                            <button type="button" class="password-toggle" id="toggle-password" aria-label="Mostrar/ocultar contraseña">
                                <i class="ri-eye-off-line"></i>
                            </button>
                        </div>
                        <span class="error-message" id="password-error"></span>
                    </div>
                    
                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Recordarme
                        </label>
                        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                    
                    <button type="submit" id="login-button" class="login-button">
                        <span>Iniciar Sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Librería para alertas elegantes -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Nuestro script de login, ahora con toggle de contraseña -->
    <script src="{{ asset('js/auth/login.js') }}"></script>
