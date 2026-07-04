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
document.addEventListener('submit', async (e) => {
  if (!e.target.matches('.add_comment')) return;
  e.preventDefault();

  const form = document.getElementById('comment_form');
  const formData = new FormData(form); // ياخد كل الحقول تلقائيًا

  const submitBtn = form.querySelector('.add_comment');
  submitBtn.disabled = true;
  submitBtn.textContent = 'جارٍ الإرسال...';

  const controller = new AbortController();
  const timeoutId = setTimeout(() => controller.abort(), 8000);

  try {
    const response = await fetch(form.action, {
      method: 'POST',
      body: formData,
      signal: controller.signal,
    });
    clearTimeout(timeoutId);

    if (!response.ok) throw new Error(`خطأ من السيرفر: ${response.status}`);

    const data = await response.json();
    renderComment(data);
  } catch (error) {
    if (error.name === 'AbortError') {
      showError('استغرق الطلب وقتًا طويلاً، حاول مجددًا');
    } else {
      showError('تعذّر إرسال التعليق، تحقق من اتصالك');
    }
    console.error(error);
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = 'إرسال التعليق';
  }
});