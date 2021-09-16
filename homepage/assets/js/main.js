// Mostrar e Esconder o Menu
const navMenu = document.getElementById('nav-menu'),
    toggleMenu = document.getElementById('nav-toggle'),
    closeMenu = document.getElementById('nav-close')
/*Utiliza-se de dinamismo para criar várias constantes a partir de uma mesma chama */

// Mostrar
toggleMenu.addEventListener('click', () => {
    navMenu.classList.toggle('show')
})
// Toggle = se a classe existir naquele elemento, ele a remove, se não existir ele a adiciona

// Esconder
closeMenu.addEventListener('click', () => {
    navMenu.classList.remove('show')
})

// MouseMove effect
document.addEventListener('mousemove', move);
function move(e) {
    this.querySelectorAll('.move').forEach(layer => {
        const speed = layer.getAttribute('data-speed')

        const x = (window.innerWidth - e.pageX * speed) / 120
        const y = (window.innerHeight - e.pageY * speed) / 120

        layer.style.transform = `translateX(${x}px) translateY(${y}px)`
    })
}

/*GSAP */
// NAV
gsap.from('.nav__logo, .nav__toggle', { opacity: 0, duration: 1, delay: 2, y: 10 })
gsap.from('.nav__item', { opacity: 0, duration: 1, delay: 2.1, y: 30, stagger: 0.2, })

// HOME
gsap.from('.home__title', { opacity: 0, duration: 1, delay: 1.6, y: 30 })
gsap.from('.home__description', { opacity: 0, duration: 1, delay: 1.8, y: 30 })
gsap.from('.home__button', { opacity: 0, duration: 1, delay: 2.1, y: 30 })
gsap.from('.home__img', { opacity: 0, duration: 1, delay: 1.3, y: 30 })


// Ir para o login
function irLogin() {
//recebemos o valor do botão pressionado ok ou cancelar em uma variavel var  var x; 
    window.location.assign('./homepage/telas/login.html')
}

    