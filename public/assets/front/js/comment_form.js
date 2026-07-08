document.addEventListener('click', async function (e) {
    if (!e.target.matches('.add_comment')) return;
    e.preventDefault();
    const form = e.target.closest('form');
    const formData = new FormData(form);
    const errorBox = document.querySelector('.error_message');
    errorBox.innerHTML = '';
    errorBox.classList.add('d-none');
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        const data = await response.json();
        if (response.ok && data.status === 'success') {
            location.reload();
            return;
        }
        renderErrors(data);
    } catch (error) {
        console.error(error);
        errorBox.innerHTML = '<ul><li class="text-danger">تعذّر إرسال التعليق، تحقق من اتصالك</li></ul>';
        errorBox.classList.remove('d-none');
    }
});

function renderErrors(errors) {
    const errorBox = document.querySelector('.error_message');
    let html = '<ul>';
    for (const key in errors) {
        errors[key].forEach(msg => {
            html += `<li class="text-danger">${msg}</li>`;
        });
    }
    html += '</ul>';
    errorBox.innerHTML = html;
    errorBox.classList.remove('d-none');
}






























// document.addEventListener('click', function(e) {
//     if (!e.target.classList.contains('add_comment')) return;

//     var form = document.getElementById('comment_form');
//     var formData = new FormData(form);
//     var errorMessage = document.querySelector('.error_message');

//     // beforeSend
//     errorMessage.innerHTML = '';
//     errorMessage.classList.add('d-none');

//     fetch(form.getAttribute('action'), {
//         method: 'POST',
//         body: new URLSearchParams(formData),
//         headers: {
//             'X-Requested-With': 'XMLHttpRequest'
//         }
//     })
//     .then(function(response) {
//         return response.json().then(function(data) {
//             return { ok: response.ok, data: data };
//         });
//     })
//     .then(function(result) {
//         if (result.ok) {
//             // success
//             if (result.data.status == true) {
//                 location.reload();
//                 errorMessage.innerHTML = '';
//                 errorMessage.classList.add('d-none');
//             }
//         } else {
//             // error (مثل 422 عند وجود أخطاء تحقق)
//             showErrors(result.data);
//         }
//     })
//     .catch(function(err) {
//         console.error('Request failed:', err);
//     });

//     e.preventDefault();
//     return false;
// });

// function showErrors(errors) {
//     var errorMessage = document.querySelector('.error_message');
//     if (errors != null) {
//         var errorHtml = '<ul>';
//         for (var key in errors) {
//             if (errors.hasOwnProperty(key)) {
//                 errors[key].forEach(function(val) {
//                     errorHtml += '<li>' + val + '</li>';
//                 });
//             }
//         }
//         errorHtml += '</ul>';
//         errorMessage.innerHTML = errorHtml;
//         errorMessage.classList.remove('d-none');
//     }
//  }