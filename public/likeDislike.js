function handle(event, id) {
    const token = event.dataset.token;
    console.log(token);
    let count = document.getElementById('count' + event.alt)

    if (event.id === 'like') {
        const fetchTo = 'http://localhost:8000/dislike/' + id;

        fetch(fetchTo, {
            method: 'GET',
            mode: 'cors',
            headers: {
                'X-CSRF-TOKEN': token,
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
            }
        }).then();

        event.src = 'images/heart_no.svg'
        event.id = 'no_like'

        count.textContent = parseInt(count.textContent) - 1 + '';

    } else {
        const fetchTo = 'http://localhost:8000/like/' + id;

        fetch(fetchTo, {
            method: 'GET',
            mode: 'cors',
            headers: {
                'X-CSRF-TOKEN': token,
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
            }
        }).then();

        event.src = 'images/heart.svg'
        event.id = 'like'

        count.textContent = parseInt(count.textContent) + 1 + '';
    }
}
