
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kamkom</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="../css/app.css" rel="stylesheet" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <style>
            
            *{
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            :root{
              --background-color:#121212 ;
              --post-color:#191919;
            }
            body{
                max-width: 100vw;
                min-height: 100vh;
                
                font-family: -apple-system, BlinkMacSystemFont, sans-serif;
                background: #121212; /* fallback for old browsers */
                overflow-x: hidden;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -o-user-select: none;
                user-select: none;
                background-color: var(--background-color);
                
            }
            body:not(.user-is-tabbing) button:focus,
            body:not(.user-is-tabbing) input:focus,
            body:not(.user-is-tabbing) select:focus,
            body:not(.user-is-tabbing) textarea:focus {
            outline: none;
            }

            a {
                text-decoration: none;
                color: inherit;
            }
            .mainContainer{
                min-height: 80vh;
                max-width: 100vw;
        
                border-radius: 12px;
                margin: 45px 70px 45px 165px;
                padding: 0;
               
                display: flex;
                gap: 20px;
            }
            .nk-breadcrumbs{
                font-family: "Montserrat", sans-serif;
                font-style: normal;
                font-weight: 700;
                padding: 0;
                margin: 0;
                color: #fff;
                text-transform: uppercase;
                list-style-type: none;
            }
            .nk-breadcrumbs > li{
        display: inline-block;
    font-size: 1.07rem;
    }
    .nk-breadcrumbs > li + li {
    margin-left: 6px;
    }
    .nk-breadcrumbs > li:last-of-type {
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 18px;
    gap: 10px;
}
.svg-inline--fa {
    display: var(--fa-display,inline-block);
    height: 1em;
    overflow: visible;
    vertical-align: -0.125em;
}
.nk-breadcrumbs > li:last-of-type::after {
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(-12px);
    margin-bottom: -3px;
}
            .userName{
                color: white;
                font-size: 23px;
                font-weight: 700;
            }

            .flexMain {
                display:flex;
                align-items: center;
                justify-content: space-between;
                padding: 0Px 70px;
                background-color: #000000e6;
            }
    
            .flexMain h1{
                font-size: 35px;
                font-weight: 800;
                color: white;font-size: 35px;
                font-weight: 800;
                text-decoration: none;
            }
            button.siteLink {
                margin-left:-5px;
                border:none;
                padding:24px;
                display:inline-block;
                min-width:115px;
                background-color: transparent;
                color: white;
                font-weight: 600;
                font-size: 17px;
                cursor: pointer;
            }
            button.siteLink:hover{
                background-color: #1f1f1f;
            }
            #mainNavigation {
            transition : transform 200ms linear;
            background : #fff;
            }
            .loading{
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 15px;
    color: white;
}
            .dot-pulse {
  position: relative;
  left: -9999px;
  width: 10px;
  height: 10px;
  border-radius: 5px;
  background-color: white;
  color: #ffffff;
  box-shadow: 9999px 0 0 -5px;
  animation: dot-pulse 1.5s infinite linear;
  animation-delay: 0.25s;
}
.dot-pulse::before, .dot-pulse::after {
  content: "";
  display: inline-block;
  position: absolute;
  top: 0;
  width: 10px;
  height: 10px;
  border-radius: 5px;
  background-color: white;
  color: white;
}
.dot-pulse::before {
  box-shadow: 9984px 0 0 -5px;
  animation: dot-pulse-before 1.5s infinite linear;
  animation-delay: 0s;
}
.dot-pulse::after {
  box-shadow: 10014px 0 0 -5px;
  animation: dot-pulse-after 1.5s infinite linear;
  animation-delay: 0.5s;
}

@keyframes dot-pulse-before {
  0% {
    box-shadow: 9984px 0 0 -5px;
  }
  30% {
    box-shadow: 9984px 0 0 2px;
  }
  60%, 100% {
    box-shadow: 9984px 0 0 -5px;
  }
}
@keyframes dot-pulse {
  0% {
    box-shadow: 9999px 0 0 -5px;
  }
  30% {
    box-shadow: 9999px 0 0 2px;
  }
  60%, 100% {
    box-shadow: 9999px 0 0 -5px;
  }
}
@keyframes dot-pulse-after {
  0% {
    box-shadow: 10014px 0 0 -5px;
  }
  30% {
    box-shadow: 10014px 0 0 2px;
  }
  60%, 100% {
    box-shadow: 10014px 0 0 -5px;
  }
}
.disabledbtn{
  color: #66666675 !important;
}
        </style>
        @vite(['resources/js/app.js'])
            <script>
                const snippets = document.querySelectorAll('.snippet');

for (let i = 0; i < snippets.length; i++) {
  snippets[i].addEventListener('mouseleave', clearTooltip);
  snippets[i].addEventListener('blur', clearTooltip);
}

function showTooltip(el, msg) {
  el.setAttribute('class', 'snippet tooltip');
  el.setAttribute('aria-label', msg);
}

function clearTooltip(e) {
  e.currentTarget.setAttribute('class', 'snippet');
  e.currentTarget.removeAttribute('aria-label');
}

const clipboardSnippets = new ClipboardJS('.snippet', {
  text: trigger => trigger.getAttribute('data-title')
});

clipboardSnippets.on('success', e => {
  e.clearSelection();
  showTooltip(e.trigger, 'Copied!');
});

clipboardSnippets.on('error', e => {
  showTooltip(e.trigger, 'Copy failed!');
});

            </script>
    </head>

    <body >
            <div id="app">
                
                <router-view></router-view>

            </div>
                
    </body>
</html>
