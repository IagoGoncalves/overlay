function iniciaToggle(classname1, toggle, classname2 = null) {
    let menu = document.getElementById(classname1);

    if (classname2) {
        let menu2 = document.getElementById(classname2);

        if (menu.classList.contains(toggle)) {
            menu.classList.remove(toggle);
            menu2.classList.add(toggle);
        }

    } else {

        if (menu.classList.contains(toggle)) {
            menu.classList.remove(toggle);

        } else {
            menu.classList.add(toggle);
        }
    }

}

if(document.getElementById("open-menu")) {
    let btnMenu = document.getElementById("open-menu");
    btnMenu.addEventListener('click', () => iniciaToggle("mobile-itens", "menu-toggle"));
}


function classActive(btn1, btn2, action) {
    let active1 = document.getElementById(btn1);
    let active2 = document.getElementById(btn2);

    if (active1.classList.contains(action)) {
        active1.classList.remove(action);
        active2.classList.add(action);

    } else {
        active1.classList.add(action);
        active2.classList.remove(action);
    }

}

if(document.getElementById("btn-pf")) {
    let btnPF = document.getElementById("btn-pf");
    btnPF.addEventListener('click', () => {
    iniciaToggle("pf", "select-toggle", "pj");
    classActive("btn-pf", "btn-pj", "active");
    });
}


if(document.getElementById("btn-pj")) {
    let btnPJ = document.getElementById("btn-pj");
    btnPJ.addEventListener('click', () => {
        iniciaToggle("pj", "select-toggle", "pf")
        classActive("btn-pj", "btn-pf", "active");
    });
}




function iniciaModal(idModal, toggle) {
    let modal = document.getElementById(idModal);
    modal.classList.add(toggle);

    modal.addEventListener("click", (evento) => {
        console.log(evento.target);

        if (evento.target.id == idModal || evento.target.className == 'exit') {
            modal.classList.remove(toggle);
        }

    })
}

if(document.getElementById("btn-video")) {
    let btnShowVideo = document.getElementById("btn-video");
    btnShowVideo.addEventListener("click", () => iniciaModal("show-video", "modal-video"));
}


if(document.getElementById('insert-user')) {
    let btnNewUser = document.getElementById('insert-user');
    btnNewUser.addEventListener("click", () => iniciaModal("new-user", "new-user-toggle"));
}
