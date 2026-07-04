<div class="container">
    <div class="comment-section">
        <!-- New Comment Form -->
        <form id="comment-form" action="{{ url('comment/news/'.request('id')) }}" method="post">
            <div class="mb-4">
                <div class="d-flex gap-3">
                    <img src="https://placehold.co/120/png" alt="User Avatar" class="user-avatar">
                    <div class="flex-grow-1">
                        <div class="d-flex flex-row align-items-center mb-3 p-1 form-color">
                            <input class="col-md-6 me-1" type="text" name="name" placeholder="{{ trans('main.name') }}"/>
                            <input class="col-md-6" type="text" name="email" placeholder="{{ trans('main.email') }}">
                        </div>
                        <textarea class="form-control comment-input" name="comment" rows="3" placeholder="{{ trans('main.write_comment') }}"></textarea>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-success add-comment text-white">{{ trans('main.submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
        document.addEventListener('submit', async (e) => {
            if (!e.target.matches('#comment-form')) return;
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.add-comment');

            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'جارٍ الإرسال...';

            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 8000);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    signal: controller.signal,
                });
                clearTimeout(timeoutId);

                if (!response.ok) throw new Error(`خطأ من السيرفر: ${response.status}`);

                const data = await response.json();
                renderComment(data);
                form.reset();
            } catch (error) {
                if (error.name === 'AbortError') {
                    showError('استغرق الطلب وقتًا طويلاً، حاول مجددًا');
                } else {
                    showError('تعذّر إرسال التعليق، تحقق من اتصالك');
                }
                console.error(error);
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });

        function renderComment(data) {
            const list = document.querySelector('.comments-list');
            const html = `
                <div class="comment-box">
                    <div class="d-flex gap-3">
                        <img src="https://placehold.co/120/png" alt="User Avatar" class="user-avatar">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">${data.name ?? ''}</h6>
                                <span class="comment-time">الآن</span>
                            </div>
                            <p class="mb-2">${data.comment ?? ''}</p>
                            <div class="comment-actions">
                                <a href="#"><i class="bi bi-heart"></i> Like</a>
                                <a href="#"><i class="bi bi-reply"></i> Reply</a>
                                <a href="#"><i class="bi bi-share"></i> Share</a>
                            </div>
                        </div>
                    </div>
                </div>`;
            list.insertAdjacentHTML('afterbegin', html);
        }

        function showError(message) {
            alert(message); // تقدر تستبدلها بأي مكتبة تنبيهات (toast, sweetalert...)
        }
        </script>

        <!-- Comments List -->
        <div class="comments-list">
            <!-- Comment 1 -->
            <div class="comment-box">
                <div class="d-flex gap-3">
                    <img src="https://placehold.co/120/png" alt="User Avatar" class="user-avatar">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">John Doe</h6>
                            <span class="comment-time">2 hours ago</span>
                        </div>
                        <p class="mb-2">This is an amazing post! Thanks for sharing your insights with us. I've
                            learned a lot from this.</p>
                        <div class="comment-actions">
                            <a href="#"><i class="bi bi-heart"></i> Like</a>
                            <a href="#"><i class="bi bi-reply"></i> Reply</a>
                            <a href="#"><i class="bi bi-share"></i> Share</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>