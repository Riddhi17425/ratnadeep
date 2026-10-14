<script>
$(function () {
    var titleField = document.getElementById(@json($titleId));
    var slugField = document.getElementById(@json($slugId));

    if (!titleField || !slugField) return;

    function slugify(value) {
        return value.toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    var currentSlug = slugify(slugField.value);
    var titleSlug = slugify(titleField.value);
    var autoGenerate = !currentSlug || currentSlug === titleSlug || currentSlug.indexOf(titleSlug + '-') === 0;

    titleField.addEventListener('input', function () {
        if (autoGenerate) slugField.value = slugify(titleField.value);
    });

    slugField.addEventListener('input', function () {
        autoGenerate = slugField.value.trim() === '';
    });
});
</script>
