document.addEventListener('DOMContentLoaded', function() {
    const galleryThumbs = document.querySelectorAll('.detail-gallery img');
    const mainImg = document.querySelector('.annonce-img');
    galleryThumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            mainImg.src = this.src;
            galleryThumbs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
});