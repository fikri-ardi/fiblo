const navbar = document.querySelector('.navbar');

document.addEventListener('scroll', () => {
    if (window.scrollY !== 0) {
        navbar.classList.add('shadow-md')
    } else {
        navbar.classList.remove('shadow-md')
    }
})
