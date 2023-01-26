const searchButton = document.querySelector('.nav__search');
const searchInput = document.querySelector('.nav__search-input');
const searchClose = document.querySelector('.nav__search-close')

searchButton.addEventListener('click', () => {
    searchButton.classList.add('nav__search-active')
    searchInput.classList.add('nav__search-input--active')
    searchClose.classList.add('nav__search-close--active')

    searchClose.addEventListener('click', () => {
        searchButton.classList.remove('nav__search-active')
        searchInput.classList.remove('nav__search-input--active')
        searchClose.classList.remove('nav__search-close--active')
    })
})

const menuButton = document.querySelector('.nav__menu')
const menuButtonIcon = menuButton.querySelector('i')
const menuModal = document.querySelector('.nav__modal')
const main = document.querySelector('.main')

menuButton.addEventListener('click', () => {
    if (menuButtonIcon.classList.contains('bx-x')) {
        menuModal.classList.remove('nav__modal-active')
        menuButtonIcon.classList.remove('bx-x')
        menuButtonIcon.classList.add('bx-menu')
        searchButton.style.display = 'flex'
        main.classList.remove('main__blur')
    } else {
        menuModal.classList.add('nav__modal-active')
        menuButtonIcon.classList.remove('bx-menu')
        menuButtonIcon.classList.add('bx-x')
        searchButton.style.display = 'none'
        main.classList.add('main__blur')
    }
})