require('./bootstrap');

// window.confirmDelete = function() {
//     const resp = confirm('Vuoi cancellare?');
//     if(!resp) {
//         event.preventDefault();
//     }
// }

const deleteForm = document.querySelectorAll('.delete-post');
console.log('sono io', deleteForm);
deleteForm.forEach(item => {
    item.addEventListener('click', function(e) {
        const resp = confirm('Vuoi cancellare?');

        if(!resp) {
            e.preventDefault();
        }
    })
})