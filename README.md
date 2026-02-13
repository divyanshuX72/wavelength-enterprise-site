# Wavelength Enterprises — Static Site

This workspace contains a mobile-first responsive static website scaffold for "Wavelength Enterprises" — a custom furniture business.

To preview locally (needs Python installed), run:

```powershell
python -m http.server 8000
# then open http://localhost:8000 in your browser
```

Files of interest:
- [index.html](index.html) — Home
- [about.html](about.html)
- [services.html](services.html)
- [products.html](products.html)
- [gallery.html](gallery.html)
- [contact.html](contact.html)
- [assets/css/styles.css](assets/css/styles.css)
- [assets/js/main.js](assets/js/main.js)

Notes:
- Uses Tailwind via CDN for fast iteration.
- Images are hotlinked to Unsplash (replace with optimized local assets for production).
- Forms are validated client-side and simulate send — integrate server/email as needed.
