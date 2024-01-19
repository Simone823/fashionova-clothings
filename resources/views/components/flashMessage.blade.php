@if ($message = Session::get('success'))
    <div class="position-fixed top-4 end-0 p-3 z-3">
        <div id="toastSuccess" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="fa-solid fa-circle-check fs-4 me-2"></i>
                <strong class="me-auto text-uppercase">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="mb-0">
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
    <script type="module">
        var toastSuccess = new bootstrap.Toast(document.getElementById('toastSuccess'));
        toastSuccess.show();
    </script>
@endif

@if ($message = Session::get('error'))
    <div class="position-fixed top-4 end-0 p-3 z-3">
        <div id="toastError" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <i class="fa-solid fa-circle-xmark fs-4 me-2"></i>
                <strong class="me-auto text-uppercase">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="mb-0">
                    {{$message}}
                </p>
            </div>
        </div>
    </div>
    <script type="module">
        var toastError = new bootstrap.Toast(document.getElementById('toastError'));
        toastError.show();
    </script>
@endif

@if ($message = Session::get('warning'))
    <div class="position-fixed top-4 end-0 p-3 z-3">
        <div id="toastWarning" class="toast bg-warning text-black" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-warning text-black">
                <i class="fa-solid fa-triangle-exclamation fs-4 me-2"></i>
                <strong class="me-auto text-uppercase">Warning</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="mb-0">
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
    <script type="module">
        var toastWarning = new bootstrap.Toast(document.getElementById('toastWarning'));
        toastWarning.show();
    </script>
@endif

@if ($message = Session::get('info'))
    <div class="position-fixed top-4 end-0 p-3 z-3">
        <div id="toastInfo" class="toast bg-info text-black" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-info text-black">
                <i class="fa-solid fa-circle-info fs-4 me-2"></i>
                <strong class="me-auto text-uppercase">Info</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="mb-0">
                    {{ $message }}
                </p>
            </div>
        </div>
    </div>
    <script type="module">
        var toastInfo = new bootstrap.Toast(document.getElementById('toastInfo'));
        toastInfo.show();
    </script>
@endif

@if ($errors->any())
    <div class="position-fixed top-4 end-0 p-3 z-3">
        <div id="toastErrorAny" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <i class="fa-solid fa-circle-xmark fs-4 me-2"></i>
                <strong class="me-auto text-uppercase">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p class="mb-0">
                    Controllare che il modulo sottostante non contenga errori!
                </p>
            </div>
        </div>
    </div>
    <script type="module">
        var toastErrorAny = new bootstrap.Toast(document.getElementById('toastErrorAny'));
        toastErrorAny.show();
    </script>
@endif