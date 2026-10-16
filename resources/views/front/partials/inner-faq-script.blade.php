<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.faq-item');
            var list = btn.closest('.faq-list');
            var open = !item.classList.contains('is-open');

            if (open && list && list.dataset.exclusive === 'true') {
                list.querySelectorAll('.faq-item.is-open').forEach(function (openItem) {
                    openItem.classList.remove('is-open');
                    openItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                });
            }

            item.classList.toggle('is-open', open);
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });
});
</script>
