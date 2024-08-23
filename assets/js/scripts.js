(() => {
    'use strict';

    if (window.bootstrap && window.bootstrap.Tooltip) {
        document.querySelectorAll('[title]').forEach((item) => {
            new window.bootstrap.Tooltip(item);
        });
    }

    document.querySelectorAll('input[type="file"]').forEach((input) => {
        input.addEventListener('change', () => {
            const label = input.closest('.mb-3')?.querySelector('.form-label');
            if (!label || !input.files.length) {
                return;
            }

            const total = input.files.length;
            label.dataset.originalText = label.dataset.originalText || label.textContent;
            label.textContent = total === 1
                ? `${label.dataset.originalText} - 1 arquivo selecionado`
                : `${label.dataset.originalText} - ${total} arquivos selecionados`;
        });
    });
})();
