@extends('back.layouts.app')
@push('title', __('Add New Article'))
@section('content')
<form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <span>
                        {{ __('Add New Article') }}
                    </span>
                </div>
                <div class="card-body pb-1">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>{{ __('Name') }}*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" max="255"
                                        onchange="document.getElementById('input_slug').value = slugify(this.value);"
                                        required value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Seo URL') }}*</label>
                                <div class="input-group">
                                    <input id="input_slug" type="text" class="form-control" name="slug" max="300"
                                        required value="{{ old('slug') }}"
                                        placeholder="{{ __('SEO Url. It will be created automatically if you leave it blank') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>
                                    {{ __('Description') }}
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text" max="300" name="description"
                                        value="{{old('description') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>
                                    {{ __('Featured Image') }}*
                                </label>
                                <input class="form-control mb-3"
                                    onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])"
                                    name="img" type="file" accept=".png, .jpg, .jpeg, .webp, .bmp" required>
                                <img width="400" id="img" class="img-fluid mb-1" src="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 shadow-sm">
            <textarea id="editor" name="content">{!! old('content') !!}</textarea>
        </div>
        <div class="col-lg-4 mx-auto d-grid">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-lg mb-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
                {{ __('Add New Article') }}
            </button>
        </div>
    </div>
</form>
@endsection
@push('js')
<script src="{{ asset('back/js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
            selector: 'textarea#editor',
            height: 400,
            images_upload_url: '',
            menubar: false,
            relative_urls: false,
            advlist_number_styles: "default",
            advlist_bullet_styles: "default",
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'h1 h2 h3 bold italic blockquote strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor hr | link image media | table emoticons codesample | ltr rtl |  removeformat help fullscreen preview code',
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote forecolor backcolor quickimage quicktable',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            automatic_uploads: true,
            image_title: true,
            paste_auto_cleanup_on_paste: true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            paste_strip_class_attributes: true,
            paste_postprocess: function(plugin, args) {
                var allElements = args.node.getElementsByTagName("img");
                for (i = 0; i < allElements.length; ++i) {
                    allElements[i].className = "img-fluid";
                }
            },

            file_picker_types: 'image',
            image_class_list: [{
                title: 'Responsive',
                value: 'img-fluid'
            }],

            /* and here's our custom image picker*/
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                // Provide image and alt text for the image dialog

                /*
                Note: In modern browsers input[type="file"] is functional without
                even adding it to the DOM, but that might not be the case in some older
                or quirky browsers like IE, so you might want to add it to the DOM
                just in case, and visually hide it. And do not forget do remove it
                once you do not need it anymore.
                */

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        /*
                        Note: Now we need to register the blob in TinyMCEs image blob
                        registry. In the next release this part hopefully won't be
                        necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }

        });
</script>
@endpush