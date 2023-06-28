// Cache on install
self.addEventListener("install", event => {
    // this.skipWaiting();
    // event.waitUntil(
    //     caches.open(staticCacheName)
    //         .then(cache => {
    //             return cache.addAll(filesToCache);
    //         })
    // )
});
// self.addEventListener("install", (event) => {

//     event.waitUntil(
        
//         (async() => {
//             try {
//                 cache_obj = await caches.open(cache)
//                 cache_obj.addAll(caching_files)
//             }
//             catch{
//                 // console.log("error occured while caching...")
//             }
//         })()
//     )
// } )
// Clear cache on activate
self.addEventListener('activate', event => {
});

// Serve from Cache
self.addEventListener("fetch", event => {
});