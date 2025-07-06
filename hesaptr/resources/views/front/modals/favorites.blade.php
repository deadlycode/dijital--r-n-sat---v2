<!-- miniFavoriteModal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="miniFavoriteModal" aria-labelledby="miniFavoriteModalLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#miniFavoriteModal"
            aria-label="Close"></button>
        <h5 class="offcanvas-title mx-auto" id="miniFavoriteModalLabel">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-balloon-heart-fill text-danger" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z" />
            </svg>
            {{ __('Favorites') }}
        </h5>

    </div>
    <div class="offcanvas-body" id="favoriteModalBody">
        <div class="spinner-border text-center" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

@push('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    const miniFavoriteModal = document.getElementById('miniFavoriteModal')
        miniFavoriteModal.addEventListener('show.bs.offcanvas', event => {
            getFavorites();
        })


        function getFavorites() {
            axios.post("{{route('favorites')}}", {
                    _token: '{{ csrf_token() }}',
                })
                .then(function(response) {
                    if (response.status == 200) {
                        document.getElementById('favoriteModalBody').innerHTML = response.data;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function deleteFavorite(id) {
            axios.post("{{route('favorites.delete')}}", {
                    _token: '{{ csrf_token() }}',
                    product_id: id
                })
                .then(function(response) {
                    if (response.status == 200) {
                        document.getElementById('favoriteModalBody').innerHTML = response.data;
                        document.querySelector('#favorite_count').innerHTML = parseInt(document.querySelector('#favorite_count').innerHTML) - 1;
                        document.querySelector('#favorite_count1').innerHTML = parseInt(document.querySelector('#favorite_count1').innerHTML) - 1;

                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
</script>
@endpush
