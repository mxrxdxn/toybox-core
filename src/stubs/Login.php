<?php

$stylesheetDir = get_bloginfo('stylesheet_directory');
$image         = "{$stylesheetDir}/images/login-background.webp";

?>

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.10);
        --glass-border: rgba(255, 255, 255, 0.22);
        --glass-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
        --text: #ffffff;
        --muted: rgba(255, 255, 255, 0.75);
        --input-bg: rgba(255, 255, 255, 0.08);
        --input-border: rgba(255, 255, 255, 0.18);
        --button-bg: rgba(255, 255, 255, 0.16);
        --button-bg-hover: rgba(255, 255, 255, 0.24);
        --button-text: #ffffff;
        --focus: rgba(255, 255, 255, 0.35);
    }

    body.login {
        min-height: 100vh;
        margin: 0;
        background:
                linear-gradient(135deg, rgba(10, 15, 30, 0.78), rgba(28, 28, 32, 0.72)),
                url("<?= $image ?>") center center / cover no-repeat fixed;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: clamp(24px, 6vw, 100px);
        position: relative;
        overflow: hidden;
    }

    body.login::before,
    body.login::after {
        content: "";
        position: fixed;
        inset: auto;
        width: 32vw;
        height: 32vw;
        min-width: 280px;
        min-height: 280px;
        border-radius: 999px;
        filter: blur(70px);
        opacity: 0.28;
        pointer-events: none;
        animation: floatGlow 14s ease-in-out infinite;
        z-index: 0;
    }

    body.login::before {
        top: -8vw;
        left: -6vw;
        background: rgba(90, 90, 100, 0.28);
    }

    body.login::after {
        right: -8vw;
        bottom: -10vw;
        background: rgba(55, 55, 62, 0.30);
        animation-delay: -7s;
    }

    #login {
        width: 100%;
        max-width: 420px;
        margin: 0;
        padding: 0;
        position: relative;
        z-index: 2;
        animation: loginEntrance 0.8s cubic-bezier(.2,.8,.2,1);
    }

    .login h1 {
        margin-bottom: 20px;
    }

    .login h1 a {
        width: 100%;
        max-width: 220px;
        height: 72px;
        background-size: contain;
        background-position: center;
        margin: 0 auto 22px;
        filter: drop-shadow(0 8px 18px rgba(255, 255, 255, 0.25));
        background-image: url('<?= $stylesheetDir ?>/images/admin-logo.svg') !important;
    }

    .login form {
        margin: 0;
        padding: 32px;
        border-radius: 24px;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(18px) saturate(160%);
        -webkit-backdrop-filter: blur(18px) saturate(160%);
        box-shadow: var(--glass-shadow);
        position: relative;
        overflow: hidden;
    }

    .login form::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
                135deg,
                rgba(255,255,255,0.22) 0%,
                rgba(255,255,255,0.08) 35%,
                rgba(255,255,255,0.02) 100%
        );
        pointer-events: none;
    }

    .login form::after {
        content: "";
        position: absolute;
        top: -30%;
        left: -60%;
        width: 45%;
        height: 160%;
        pointer-events: none;
        transform: rotate(18deg);
        background: linear-gradient(
                90deg,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.05) 35%,
                rgba(255,255,255,0.22) 50%,
                rgba(255,255,255,0.05) 65%,
                rgba(255,255,255,0) 100%
        );
        filter: blur(10px);
        opacity: 0.85;
        animation: glassShimmer 8s ease-in-out infinite;
    }

    .login label {
        color: var(--muted);
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.02em;
    }

    .login input[type="text"],
    .login input[type="password"],
    .login input[type="email"] {
        background: var(--input-bg);
        border: 1px solid var(--input-border);
        color: var(--text);
        border-radius: 14px;
        min-height: 52px;
        padding: 0 16px;
        font-size: 15px;
        box-shadow: none;
        transition: border-color 0.25s ease, background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .login input[type="text"]:focus,
    .login input[type="password"]:focus,
    .login input[type="email"]:focus {
        background: rgba(255, 255, 255, 0.12);
        border-color: var(--focus);
        color: var(--text);
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.08);
        transform: translateY(-1px);
        outline: none;
    }

    .login input[type="text"]::placeholder,
    .login input[type="password"]::placeholder,
    .login input[type="email"]::placeholder {
        color: rgba(255, 255, 255, 0.45);
    }

    .login .button-primary {
        width: 100%;
        min-height: 52px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 14px;
        background: var(--button-bg);
        color: var(--button-text);
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0.02em;
        text-shadow: none;
        box-shadow: none;
        transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .login .button-primary:hover,
    .login .button-primary:focus {
        background: var(--button-bg-hover);
        border-color: rgba(255, 255, 255, 0.28);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.18);
        color: #fff;
    }

    .login .forgetmenot {
        margin-top: 6px;
    }

    .login .forgetmenot label {
        color: var(--muted);
        font-weight: 500;
    }

    .login #nav,
    .login #backtoblog {
        text-align: center;
        margin-top: 16px;
    }

    .login #nav a,
    .login #backtoblog a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.2s ease, opacity 0.2s ease;
    }

    .login #nav a:hover,
    .login #backtoblog a:hover {
        color: #ffffff;
        opacity: 1;
    }

    .login .message,
    .login .notice,
    .login #login_error {
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-left: 4px solid rgba(255, 255, 255, 0.45);
        background: rgba(15, 15, 25, 0.35);
        color: #fff;
        border-radius: 16px;
        box-shadow: var(--glass-shadow);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .login .dashicons {
        color: rgba(255, 255, 255, 0.7);
    }

    input[type="checkbox"] {
        border-radius: 4px;
        border-color: rgba(255, 255, 255, 0.28);
        background: rgba(255, 255, 255, 0.08);
    }

    input[type="checkbox"]:checked::before {
        color: #fff;
    }

    .language-switcher {
        display: none;
    }

    @keyframes loginEntrance {
        from {
            opacity: 0;
            transform: translateY(24px) scale(0.985);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes floatGlow {
        0%, 100% {
            transform: translate3d(0, 0, 0) scale(1);
        }
        50% {
            transform: translate3d(20px, -20px, 0) scale(1.08);
        }
    }

    @media (max-width: 700px) {
        body.login {
            justify-content: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        #login {
            max-width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        body.login::before,
        body.login::after,
        #login,
        .login form::after {
            animation: none !important;
        }

        .login input,
        .login .button-primary {
            transition: none !important;
        }
    }

    @keyframes glassShimmer {
        0% {
            left: -60%;
            opacity: 0;
        }
        8% {
            opacity: 1;
        }
        45% {
            left: 120%;
            opacity: 1;
        }
        55% {
            left: 120%;
            opacity: 0;
        }
        100% {
            left: 120%;
            opacity: 0;
        }
    }
</style>
