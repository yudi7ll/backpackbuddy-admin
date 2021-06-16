var staticCacheName = "backpackbuddy-admin" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/images/icons/apple-icon-180.png',
    '/images/icons/manifest-icon-192.png',
    '/images/icons/manifest-icon-512.png',
    '/images/icons/apple-splash-640-1136.jpg',
    '/images/icons/apple-splash-750-1334.jpg',
    '/images/icons/apple-splash-828-1792.jpg',
    '/images/icons/apple-splash-1125-2436.jpg',
    '/images/icons/apple-splash-1242-2208.jpg',
    '/images/icons/apple-splash-1242-2688.jpg',
    '/images/icons/apple-splash-1536-2048.jpg',
    '/images/icons/apple-splash-1668-2224.jpg',
    '/images/icons/apple-splash-1668-2388.jpg',
    '/images/icons/apple-splash-2048-2732.jpg',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("backpackbuddy-admin")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
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
