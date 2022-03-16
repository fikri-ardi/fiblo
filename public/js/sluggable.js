const title = document.querySelector('#title');
const slug = document.querySelector('#slug');

title.addEventListener('change', () => {
    fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
})

document.addEventListener('trix-file-accept', (e) => e.preventDefault())
