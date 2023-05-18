let smClose = document.querySelector('.sm-close');
let sidebar = document.querySelector('.l-sidebar');
let toggle = document.querySelector('.house_toggle');
let themeToggler = document.querySelector('.theme-toggler');
let fullscreenBtn = document.querySelector('.fullscreen-btn');


let allowed = {
   css :  "link[rel=stylesheet]",
   js : "script",
   all : ''
}
let refreshFile = (type) => {
    return (new Set(Object.keys(allowed)).has(type)) && refreshDocument(type);
}
let refreshDocument = (type) => {
    let selector = type == "all" ? `${allowed['css']},${allowed['js']}` : allowed[type];
    for (let elem of document.querySelectorAll(selector)) {
        let attr = elem.tagName == "SCRIPT" ? "src" : "href";
        elem[attr] = elem[attr].replace(/\?.*|$/, "?" + Date.now());
    }
    return true;
}

window.addEventListener('load', () => {
    
    responsiveSideBar();
    smClose.addEventListener('click', () => {
        event.preventDefault();
        doToggleNav();
    })
    themeToggler.addEventListener('click', (e) => {
        let body = document.body;
        let appTheme = document.querySelector('#app-theme');
        if(body.classList.contains('dark')){
            appTheme.href='/css/light-theme.css';
            e.currentTarget.querySelector('.nav-icon').classList.remove('text-light');
            e.currentTarget.querySelector('.nav-icon').classList.add('text-warning');
            body.classList.remove('dark');
            body.classList.add('light')
        } else {
            appTheme.href='/css/style.css';
            e.currentTarget.querySelector('.nav-icon').classList.remove('text-warning');
            e.currentTarget.querySelector('.nav-icon').classList.add('text-light');
            body.classList.add('dark');
            body.classList.remove('light')
        }
    });
    // setTimeout(() => {
    //     refreshFile('all');
    // });
});
toggle.addEventListener('click', doToggleNav);

function doToggleNa(){
    clearTimeout(window.slideInSpeed);
    clearTimeout(window.slideOutSpeed);
    if(sidebar.classList.contains('sidebar-slide-out')){
        sidebar.classList.remove('sidebar-slide-out');
        sidebar.style.animation = 'sidebar-slide-in 500ms ease-in 0ms forwards';
        // window.slideInSpeed = setTimeout(() => {
            // sidebar.style.transform = '';
        // })
    } else {
        sidebar.classList.remove('sidebar-slide-in');
        sidebar.classList.add('sidebar-slide-out');
        sidebar.style.animation = 'sidebar-slide-out 1500ms ease-in 0ms forwards';
        // window.slideOutSpeed = setTimeout(() => {
        //     // sidebar.style.transform = 'translateX(-200%)';
        // })
    }
}
function doToggleNav(){
    if(sidebar.classList.contains('sidebar-active')){
        sidebar.classList.remove('sidebar-active');
        sidebar.classList.remove('show');
    } else {
        sidebar.classList.add('sidebar-active');
        sidebar.classList.add('show');
    }
}

window.addEventListener('resize', () => {
    responsiveSideBar();
});

function responsiveSideBar(){
    let deviceWidth = window.innerWidth;
    if(deviceWidth < 992){
        sidebar.classList.remove('sidebar-active');
    } else {
        sidebar.classList.add('sidebar-active');
    }
}

fullscreenBtn.addEventListener('click', function (e) {
	if (document.fullscreenElement) {
        e.currentTarget.querySelector('.nav-icon').classList.remove('fa-compress');
        e.currentTarget.querySelector('.nav-icon').classList.add('fa-expand');
        document.exitFullscreen();
	} else {
        e.currentTarget.querySelector('.nav-icon').classList.add('fa-compress');
        e.currentTarget.querySelector('.nav-icon').classList.remove('fa-expand');
		document.documentElement.requestFullscreen();
	}
}, false);
