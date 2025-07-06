@extends('back.layouts.app')
@push('title',$article->name)
@section('content')
<form action="{{ route('admin.article.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $article->id }}">
    <div class="row g-3">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <span>
                        {{ __('Edit Article') }} "{{ __($article->name) }}"
                    </span>
                </div>
                <div class="card-body pb-1">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>{{ __('Name') }}*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" max="255"
                                        onchange="document.getElementById('input_slug').value = slugify(this.value);document.getElementById('meta_title').value = slugify(this.value)"
                                        value="{{ $article->name }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Seo URL') }}*</label>
                                <div class="input-group">
                                    <input id="input_slug" type="text" class="form-control" name="slug" max="300"
                                        required
                                        placeholder="{{ __('SEO Url. It will be created automatically if you leave it blank') }}"
                                        value="{{ $article->slug }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>
                                    {{ __('Description') }}
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text" max="300" name="description"
                                        value="{{$article->description}}">
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
                                    name="img" type="file" accept=".png, .jpg, .jpeg, .webp, .bmp">
                                <img width="200" id="img" class="img-fluid mb-1" src="{{ asset($article->img) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 shadow-sm">
            <textarea id="editor" name="content">{!! $article->content !!}</textarea>
        </div>
        <div class="col-lg-6 mx-auto d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cloud-arrow-up mb-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z" />
                    <path
                        d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                </svg>
                {{ __('Update') }}
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