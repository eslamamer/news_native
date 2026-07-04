// document.addEventListener('submit', async (e) => {
//   if (!e.target.matches('.add_comment')) return;
//   e.preventDefault();
//   const form = document.getElementById('comment_form');
//   const formData = new FormData(form);
//   const submitBtn = form.querySelector('.add_comment');
//   submitBtn.disabled = true;
//   submitBtn.textContent = 'جارٍ الإرسال...';
//   const controller = new AbortController();
//   const timeoutId = setTimeout(() => controller.abort(), 8000);
//   try {
//     const response = await fetch(form.action, {
//       method: 'POST',
//       body: formData,
//       signal: controller.signal,
//     });
//     clearTimeout(timeoutId);
//     if (!response.ok) {
//       throw new Error(`خطأ من السيرفر: ${response.status}`);
//     }
//     const data = await response.json();
//     renderComment(data);
//   } catch (error) {
//     if (error.name === 'AbortError') {
//       showError('استغرق الطلب وقتًا طويلاً، حاول مجددًا');
//     } else {
//       showError('تعذّر إرسال التعليق، تحقق من اتصالك');
//     }
//     console.error(error);
//   } finally {
//     submitBtn.disabled = false;
//     submitBtn.textContent = 'إرسال التعليق';
//   }
// });

// document.addEventListener('submit', async (e) => {
//     if (!e.target.matches('#comment-form')) return;
//     e.preventDefault();

//     const form = e.target;
//     const formData = new FormData(form);
//     const submitBtn = form.querySelector('.add-comment');

//     submitBtn.disabled = true;
//     const originalText = submitBtn.textContent;
//     submitBtn.textContent = 'جارٍ الإرسال...';

//     const controller = new AbortController();
//     const timeoutId = setTimeout(() => controller.abort(), 8000);

//     try {
//         const response = await fetch(form.action, {
//             method: 'POST',
//             body: formData,
//             headers: { 'X-Requested-With': 'XMLHttpRequest' },
//             signal: controller.signal,
//         });
//         clearTimeout(timeoutId);

//         if (!response.ok) throw new Error(`خطأ من السيرفر: ${response.status}`);

//         const data = await response.json();
//         renderComment(data);
//         form.reset();
//     } catch (error) {
//         if (error.name === 'AbortError') {
//             showError('استغرق الطلب وقتًا طويلاً، حاول مجددًا');
//         } else {
//             showError('تعذّر إرسال التعليق، تحقق من اتصالك');
//         }
//         console.error(error);
//     } finally {
//         submitBtn.disabled = false;
//         submitBtn.textContent = originalText;
//     }
// });

// function renderComment(data) {
//     const list = document.querySelector('.comments-list');
//     const html = `
//         <div class="comment-box">
//             <div class="d-flex gap-3">
//                 <img src="https://placehold.co/120/png" alt="User Avatar" class="user-avatar">
//                 <div class="flex-grow-1">
//                     <div class="d-flex justify-content-between align-items-center mb-2">
//                         <h6 class="mb-0">${data.name ?? ''}</h6>
//                         <span class="comment-time">الآن</span>
//                     </div>
//                     <p class="mb-2">${data.comment ?? ''}</p>
//                     <div class="comment-actions">
//                         <a href="#"><i class="bi bi-heart"></i> Like</a>
//                         <a href="#"><i class="bi bi-reply"></i> Reply</a>
//                         <a href="#"><i class="bi bi-share"></i> Share</a>
//                     </div>
//                 </div>
//             </div>
//         </div>`;
//     list.insertAdjacentHTML('afterbegin', html);
// }

// function showError(message) {
//     alert(message); // تقدر تستبدلها بأي مكتبة تنبيهات (toast, sweetalert...)
// }
