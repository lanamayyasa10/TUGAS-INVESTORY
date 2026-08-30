document.addEventListener('click', function (event) {
    const link = event.target.closest('[data-confirm]');
    if (!link) return;

    const message = link.getAttribute('data-confirm') || 'Yakin?';
    if (!window.confirm(message)) {
        event.preventDefault();
    }
});
