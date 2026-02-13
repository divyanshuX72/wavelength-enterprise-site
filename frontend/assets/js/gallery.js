document.addEventListener('DOMContentLoaded', function() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');

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

      const filterValue = btn.getAttribute('data-filter');

      galleryItems.forEach(item => {
        const itemCategory = item.getAttribute('data-category');

        if (filterValue === 'all' || filterValue === itemCategory) {
          item.classList.remove('hidden');
          item.classList.add('fade-in'); // Add animation class if css supports it
          // Reset animation
          item.style.opacity = '0';
          setTimeout(() => item.style.opacity = '1', 50);
        } else {
          item.classList.add('hidden');
        }
      });
    });
  });
});
