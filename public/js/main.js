document.addEventListener('DOMContentLoaded', () => {
    const $form = document.querySelector('form')
    const $input = document.querySelector('input[name="url"]')
    const $notify = document.getElementById('notify')
    const $btnClose = document.querySelector('.notification .delete')
    const $inputUrl = document.getElementById('redirectUrl')
    const $originUrl = document.getElementById('originUrl')

    $inputUrl.value = ''

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
            $inputUrl.value = shortUrl
            $originUrl.innerText = result.url
        })
    })

    const $btnCopy = document.getElementById('copy')
                
    $btnCopy.addEventListener('click', () => {
        $inputUrl.select()
        const originalText = $btnCopy.innerText;
        $btnCopy.innerText = 'Copied!';
        setTimeout(() => {
            $btnCopy.innerText = originalText;
        }, 5000);    
        document.execCommand("copy")
    })
});
