<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CONECCION ESTABLECIDA</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#090909;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    font-family:Consolas, monospace;
    position:relative;
}

/* GRID */

body::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        linear-gradient(rgba(0,255,120,.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,255,120,.08) 1px, transparent 1px);
    background-size:160px 160px;
    opacity:.35;
}

/* TERMINAL */

.cyber-terminal{
    width:450px;
    height:620px;
    border:2px solid #1ae4ff;
    border-radius:12px;
    background:#020202;
    position:relative;
    box-shadow:
        0 0 15px rgba(0, 255, 255, 0.98),
        0 0 40px rgba(0, 132, 255, 0.5);
    overflow:hidden;
}

/* HEADER */

.terminal-header{
    height:55px;
    border-bottom:1px solid #1ae4ff;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 22px;
    background:rgba(255,255,255,.02);
}

.terminal-buttons{
    display:flex;
    gap:10px;
}

.term-btn{
    width:16px;
    height:16px;
    border-radius:50%;
}

.red{
    background:#d67a7a;
}

.yellow{
    background:#d6d27a;
}

.green{
    background:#7ad67a;
}

.terminal-title{
    color:#39ff88;
    font-size:15px;
    font-weight:bold;
    letter-spacing:1px;
}

/* CONTENT */

.content{
    width:100%;
    height:calc(100% - 55px);
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:65px;
}

/* LOGO */

.logo-wrapper{
    position:relative;
    width:75px;
    height:75px;
    margin-bottom:35px;
}

.logo-box{
    width:75px;
    height:75px;
    border:2px solid #ff2ea6;
    display:flex;
    justify-content:center;
    align-items:center;
    position:relative;
    z-index:2;
    background:rgba(255,0,128,.05);
    box-shadow:0 0 18px rgba(255,0,128,.4);
}

.logo-box svg{
    color:#39ff88;
}

.logo-scan{
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(
        90deg,
        transparent,
        rgba(22, 255, 255, 0.85),
        transparent
    );
    animation:scan 2s linear infinite;
}

@keyframes scan{
    0%{
        left:-100%;
    }

    100%{
        left:100%;
    }
}

/* TITLE */

.main-title{
    color:#39ff88;
    font-size:26px;
    font-weight:bold;
    letter-spacing:5px;
    margin-bottom:14px;
    text-shadow:0 0 10px rgba(57, 248, 255, 0.69);
}

.subtitle{
    color:#ff2ea6;
    font-size:11px;
    letter-spacing:3px;
    margin-bottom:60px;
}

/* SUCCESS */

.success-wrapper{
    display:flex;
    flex-direction:column;
    align-items:center;
}

/* RINGS */

.success-rings{
    position:relative;
    width:110px;
    height:110px;
    margin-bottom:45px;
}

.ring{
    position:absolute;
    border:2px solid #39ffff;
    border-radius:50%;
    inset:0;
    animation:pulse 2s infinite;
}

.ring:nth-child(2){
    inset:14px;
    animation-delay:.3s;
}

.ring:nth-child(3){
    inset:28px;
    animation-delay:.6s;
}

@keyframes pulse{

    0%{
        opacity:.3;
        transform:scale(.95);
    }

    50%{
        opacity:1;
        transform:scale(1);
    }

    100%{
        opacity:.3;
        transform:scale(.95);
    }
}

/* CHECK */

.check{
    position:absolute;
    inset:0;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#39ff88;
    font-size:42px;
    font-weight:bold;
}

/* CONNECTION */

.connection{
    color:#39ff88;
    font-size:16px;
    text-align:center;
    line-height:1.6;
    letter-spacing:3px;
    font-weight:bold;
    text-shadow:0 0 10px rgba(57, 248, 255, 0.85);
}

.connection span{
    display:block;
}

/* DESC */

.desc{
    margin-top:18px;
    color:#39ff88;
    opacity:.7;
    font-size:10px;
    letter-spacing:2px;
}

/* GLOW */

.cyber-terminal::after{
    content:"";
    position:absolute;
    inset:0;
    pointer-events:none;
    background:linear-gradient(
        transparent,
        rgba(57,255,136,.03),
        transparent
    );
    animation:glowMove 4s linear infinite;
}

@keyframes glowMove{

    0%{
        transform:translateY(-100%);
    }

    100%{
        transform:translateY(100%);
    }
}

</style>
</head>

<body>

<div class="cyber-terminal">

    <div class="terminal-header">

        <div class="terminal-buttons">
            <div class="term-btn red"></div>
            <div class="term-btn yellow"></div>
            <div class="term-btn green"></div>
        </div>

        <div class="terminal-title">
            NEURAL_INTERFACE.EXE
        </div>

    </div>

    <div class="content">

        <div class="logo-wrapper">

            <div class="logo-box">

                <svg width="38" height="38" viewBox="0 0 24 24" fill="none">

                    <path
                        d="M12 2L20 6.5V17.5L12 22L4 17.5V6.5L12 2Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="3.5"
                        stroke="currentColor"
                        stroke-width="1.8"
                    />

                </svg>

            </div>

            <div class="logo-scan"></div>

        </div>

        <h1 class="main-title">
            CYPHER_NET
        </h1>

        <div class="subtitle">
            [ ACCESO_TERMINAL_SEGURO ]
        </div>

        <div class="success-wrapper">

            <div class="success-rings">

                <div class="ring"></div>
                <div class="ring"></div>
                <div class="ring"></div>

                <div class="check">
                    ✓
                </div>

            </div>

            <div class="connection">
                <span>[ CONEXION_ESTABLECIDA ]</span>
            </div>

            <div class="desc">
                ACCEDIENDO A LA INTERFAZ...
            </div>

        </div>

    </div>

</div>
<script>
setTimeout(() => {
    window.location.href = "/panel";
}, 3000);
</script>

</body>
</html>