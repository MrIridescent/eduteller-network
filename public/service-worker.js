/**
 * Eduteller Offline-First Service Worker
 * Focus: High performance in low-connectivity (Nigeria) environments.
 */

const CACHE_NAME = 'eduteller-v1-narrative-cache';
const STATIC_ASSETS = [
    '/',
    '/css/app.css',
    '/js/app.js',
    '/offline',
    '/images/mentor-avatar.png'
];

// 1. Install & Cache Shell
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(STATIC_ASSETS))
    );
});

// 2. Network-First for Quizzes, Cache-First for Stories
self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    if (url.pathname.includes('/api/v1/quizzes')) {
        event.respondWith(networkFirst(event.request));
    } else {
        event.respondWith(cacheFirst(event.request));
    }
});

async function cacheFirst(request) {
    const cachedResponse = await caches.match(request);
    return cachedResponse || fetch(request);
}

async function networkFirst(request) {
    const cache = await caches.open(CACHE_NAME);
    try {
        const networkResponse = await fetch(request);
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    } catch (error) {
        return caches.match(request);
    }
}

// 3. Background Sync for xAPI Statements
self.addEventListener('sync', event => {
    if (event.tag === 'sync-xapi-statements') {
        event.waitUntil(syncXApiStatements());
    }
});

async function syncXApiStatements() {
    // Logic to pull statements from IndexedDB and POST to /api/v1/xapi/sync
    console.log('Syncing xAPI statements from IndexedDB...');
}
