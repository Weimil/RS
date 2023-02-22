function hola(event) {
    let countNombre='count'+event.alt
    console.log(countNombre)
    let count=document.getElementById(countNombre)
    if (event.id == 'like') {
        fetch('http://redsocial.local.com/dislike/' + event.alt)
        event.src = 'images/favoritoNo.png'
        event.id = 'Nolike'
        let number=parseInt(count.textContent);
        count.textContent=number-1
    } else {
        fetch('http://redsocial.local.com/like/' + event.alt)
        event.src = 'images/favorito.png'
        event.id = 'like'
        let number=parseInt(count.textContent);
        count.textContent=number+1
    }
}

// function comentar(event) {
//     //console.log(document.getElementsByName('csrf-token')[0].content)
//     const coment = document.getElementsByName('comentario' + event.id.split('.')[0])[0].value
//     fetch('http://redsocial.local.com/save_comentario', {
//         method: 'POST',
//         body: JSON.stringify({
//             user_id:event.id.split('.')[1],
//             image_id:  event.id.split('.')[0],
//             content: coment
//         }),
//         headers: {
//             //'X-CSRF-TOKEN':document.querySelector("meta[name='csrf-token']").getAttribute('content'),
//             "Content-type": "application/json; charset=UTF-8"
//         }
//     })
//         .then(response=>response.json())
//         .then(data=>{
//             document.getElementById('nuevoComent'+event.id.split('.')[0]).textContent='Nuevo Comentario: '+data.content
//             console.log(data)
//         })
// }

