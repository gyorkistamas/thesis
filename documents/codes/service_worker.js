var filesToCache = [
    '/offline',
    '/bootstrap.min.css',
    '/rsz_def_logo.png'
];

// Gyorsítótárazás
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Kiszolgálás gyorsítótárból, ha nincs kapcsolat.
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});