function handle(event, id) {
    let countNombre = 'count' + event.alt;

    let count = document.getElementById(countNombre)

    if (event.id === 'like') {

        fetch('https://localhost:8000/dislike/' + id);

        event.src = 'images/heart_no.svg'
        event.id = 'no_like'

        count.textContent = parseInt(count.textContent) - 1 + '';

    } else {
        fetch('https://localhost:8000/like/' + id);

        event.src = 'images/heart.svg'
        event.id = 'like'

        count.textContent = parseInt(count.textContent) + 1 + '';
    }
}
