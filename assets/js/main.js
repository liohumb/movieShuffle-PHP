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