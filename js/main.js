document.addEventListener('DOMContentLoaded', () => {
    (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
        const $notification = $delete.parentNode;

        $delete.addEventListener('click', () => {
        $notification.parentNode.removeChild($notification);
        });
    });

    // Form          
    const $form = document.querySelector('form')
    const $input = document.querySelector('input[name="url"]')
    const $notify = document.getElementById('notify')
    const $link = document.getElementById('link')

    $form.addEventListener('submit', e => {
        e.preventDefault()
        
        let data = new FormData($form);

        fetch('/form.php', {
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
