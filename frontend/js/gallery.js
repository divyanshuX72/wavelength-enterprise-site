document.addEventListener('DOMContentLoaded', function () {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');

  function filterGallery(filterValue) {
    galleryItems.forEach(item => {
      const itemCategory = item.getAttribute('data-category');

      if (filterValue === itemCategory) {
        item.classList.remove('hidden');
        item.classList.add('fade-in');
        item.style.opacity = '0';
        setTimeout(() => item.style.opacity = '1', 50);
      } else {
        item.classList.add('hidden');
      }
    });
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Remove active class from all buttons
      filterBtns.forEach(b => {
        b.classList.remove('active', 'bg-wood', 'text-black', 'border-wood');
        b.classList.add('border-gray-600', 'text-gray-300');
      });

      // Add active class to clicked button
      btn.classList.add('active', 'bg-wood', 'text-black', 'border-wood');
      btn.classList.remove('border-gray-600', 'text-gray-300');

      filterGallery(btn.getAttribute('data-filter'));
    });
  });

  // Auto-filter to the default active button on page load
  const activeBtn = document.querySelector('.filter-btn.active');
  if (activeBtn) {
    filterGallery(activeBtn.getAttribute('data-filter'));
  }
});
