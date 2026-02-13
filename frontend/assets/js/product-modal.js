// Quick View Modal Logic
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('quick-view-modal');
    const closeBtn = document.getElementById('modal-close-btn');
    const quickViewBtns = document.querySelectorAll('.quick-view-btn');

    // Elements to populate
    const modalImg = document.getElementById('modal-img');
    const modalTitle = document.getElementById('modal-title');
    const modalPrice = document.getElementById('modal-price');
    const modalDesc = document.getElementById('modal-desc');
    const modalMaterials = document.getElementById('modal-materials');
    const modalSizes = document.getElementById('modal-sizes');
    const waLink = document.getElementById('modal-wa-link');

    // Functions
    const openModal = (btn) => {
        const card = btn.closest('article');

        // Extract data
        const imgSrc = card.querySelector('img').src;
        const title = card.querySelector('h2').textContent;
        const price = card.querySelector('.text-wood').textContent;
        // Basic description logic (or dataset)
        const desc = "Experience premium craftsmanship with our " + title + ". Custom built to your specifications.";

        // Extract stats from the list
        const rows = card.querySelectorAll('.space-y-2 > div');
        let materialText = "";
        let sizeText = "";

        rows.forEach(row => {
            if (row.textContent.includes('Material:')) materialText = row.querySelector('span:last-child').textContent;
            if (row.textContent.includes('Sizes:')) sizeText = row.querySelector('span:last-child').textContent;
        });

        // Populate
        modalImg.src = imgSrc;
        modalTitle.textContent = title;
        modalPrice.textContent = price;
        modalDesc.textContent = desc;

        if (modalMaterials) modalMaterials.textContent = materialText;
        if (modalSizes) modalSizes.textContent = sizeText;

        // WhatsApp Link
        const waMsg = `Hi, I'm interested in the ${title} (Quick View)`;
        waLink.href = `https://wa.me/919373154925?text=${encodeURIComponent(waMsg)}`;

        // Show
        modal.classList.remove('hidden');
        // Small delay for fade in
        setTimeout(() => {
            modal.querySelector('.modal-backdrop').classList.add('opacity-100');
            modal.querySelector('.modal-content').classList.remove('scale-95', 'opacity-0');
            modal.querySelector('.modal-content').classList.add('scale-100', 'opacity-100');
        }, 10);

        document.body.style.overflow = 'hidden'; // Prevent scrolling
    };

    const closeModal = () => {
        modal.querySelector('.modal-backdrop').classList.remove('opacity-100');
        modal.querySelector('.modal-content').classList.remove('scale-100', 'opacity-100');
        modal.querySelector('.modal-content').classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    };

    // Event Listeners
    quickViewBtns.forEach(btn => btn.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(btn);
    }));

    closeBtn.addEventListener('click', closeModal);

    // Close on backdrop click
    modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target.classList.contains('modal-backdrop')) {
            closeModal();
        }
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
