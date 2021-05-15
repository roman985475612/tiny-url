document.addEventListener('DOMContentLoaded', () => {
    const $form = document.querySelector('form')
    const $input = document.querySelector('input[name="url"]')
    const $notify = document.getElementById('notify')
    const $btnClose = document.querySelector('.notification .delete')
    const $link = document.getElementById('link')

    $btnClose.addEventListener('click', e => {
        $notify.classList.add('is-hidden')
    })

    $form.addEventListener('submit', e => {
        e.preventDefault()
        
        let data = new FormData($form);

        fetch('/form', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(result => {
            $input.value = ''

            shortUrl = window.location.origin + '/' + result.short

            $notify.classList.remove('is-hidden')
            $link.innerText = shortUrl
            $link.setAttribute('href', shortUrl)
        })
    })
});
