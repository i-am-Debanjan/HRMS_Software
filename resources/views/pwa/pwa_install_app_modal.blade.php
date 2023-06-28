<!-- Modal -->
    <div class="modal fade" id="install_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content card border-0">
                <img src="{{asset('/img/install_app_3.jpg')}}" class="card-img" alt="...">
                <div class="card-img-overlay text-center">
                    <button type="button" class="btn-close text-dark float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    <p class="fs-4 fw-bold text-dark align-middle text-success mt-5 mt-md-4  text-center"><i class="fab fa-google-play"></i> Install Our App </p>
                    <button class="btn btn-danger btn-sm fst-italic" id="install_later"><i class="fas fa-history"></i> Remind Later</button>
                    <button class="btn btn-success btn-sm fst-italic" id="install_now"><i class="fas fa-download"></i> Install Now</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //window.addEventListener('online', () => {
        //    window.location.href = "/";
        //});
        //window.addEventListener('offline', () => {
        //    window.location.href = "/";
        //});
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', function(event) {
            event.preventDefault();
            deferredPrompt = event;
            $('#install_modal').modal('show');
        });
        btnAdd = document.getElementById('install_now');
        btnremove = document.getElementById('install_later');
        btnremove.addEventListener('click', (e) => {
            $('#install_modal').modal('hide');
        });
        btnAdd.addEventListener('click', (e) => {
            deferredPrompt.prompt();
            deferredPrompt.userChoice
                .then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        $('#install_modal').modal('hide');
                    } else {
                        $('#install_modal').modal('hide');
                    }
                    deferredPrompt = null;
                });
        });

    </script>