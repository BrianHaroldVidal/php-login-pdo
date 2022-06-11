document.getElementById('banner').innerHTML = `
<div id="selector" onclick="openSlideMenu()">
           <svg height="30" width="30">
              <path d="M0,09 30,09" stroke=#fff stroke-width="5"/>
              <path d="M0,18 30,18" stroke=#fff stroke-width="5"/>
              <path d="M0,27 30,27" stroke=#fff stroke-width="5"/>
           </svg>
        </div>
        <div id="navbar">
            <span>January 29, 2022</span>
        </div>
        <div id="bannerChild">
            <div id="imageCon"></div>
            <div id="imageCon"></div>
            <div id="imageCon"></div>
            <div id="imageCon"></div>
        </div>
        <div id="side-menu" class="side-nav">
            <a href="#" onclick="closeSlideMenu()">X</a>
            <a href="login.php" onclick="closeSlideMenu()">Login</a>
        </div>
`;
function openSlideMenu(){
    document.getElementById('side-menu').style.width = "250px";
}

function closeSlideMenu(){
    document.getElementById('side-menu').style.width = "0";
}