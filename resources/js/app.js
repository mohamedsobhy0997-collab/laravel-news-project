import './bootstrap';

window.Echo.private('users.' + id)
    .notification((event) => {
        console.log(event);
    });