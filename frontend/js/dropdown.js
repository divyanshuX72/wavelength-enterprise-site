document.querySelectorAll('.dd').forEach(dd => {
    const btn = dd.querySelector('.dd-btn');
    const list = dd.querySelector('.dd-list');

    btn.onclick = () => {
        document.querySelectorAll('.dd-list').forEach(l => {
            if (l !== list) l.style.display = 'none';
        });
        // Toggle logic
        if (list.style.display === 'block') {
            list.style.display = 'none';
            btn.classList.remove('active');
        } else {
            list.style.display = 'block';
            btn.classList.add('active');
        }
    };

    dd.querySelectorAll('.dd-item').forEach(item => {
        item.onclick = () => {
            btn.innerText = item.innerText;
            // Update hidden input if it exists
            const hiddenInput = dd.querySelector('input[type="hidden"]');
            if (hiddenInput) {
                hiddenInput.value = item.innerText; // Use text content as value
                // Trigger change event if needed for validation
                hiddenInput.dispatchEvent(new Event('change'));
            }
            
            dd.querySelectorAll('.dd-item').forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
            list.style.display = 'none';
            btn.classList.remove('active');
        };
    });
});

document.addEventListener('click', e => {
    if (!e.target.closest('.dd')) {
        document.querySelectorAll('.dd-list').forEach(l => l.style.display = 'none');
        document.querySelectorAll('.dd-btn').forEach(b => b.classList.remove('active'));
    }
});
