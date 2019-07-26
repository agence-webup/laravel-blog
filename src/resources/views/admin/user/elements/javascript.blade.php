<script src="{{ asset("vendor/laravel-blog/node_modules/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js") }}"></script>
<script src="{{ asset("vendor/laravel-blog/node_modules/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js") }}"></script>
<script src="{{ asset("vendor/laravel-blog/node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js") }}"></script>
<script src="{{ asset("vendor/laravel-blog/node_modules/filepond/dist/filepond.min.js") }}"></script>
<script>
    let fileInput = document.querySelector('#file')

    FilePond.registerPlugin(
        FilePondPluginImageTransform,
        FilePondPluginImageResize,
        FilePondPluginImagePreview
    );

    FilePond.create(
        fileInput,
        {
            imageResizeTargetWidth:400,
            imageResizeTargetHeight:400,
            imageCropAspectRatio: 1,
            files: [
                {
                    source: fileInput.dataset.pic,
                    options: {
                        type: 'local'
                    }
                }
            ],
            server: {
                process: {
                    url: fileInput.dataset.post,
                    method: 'POST',
                    onload: (response) => {
                        var pictureInput = document.querySelector('[data-js=picture]');
                        pictureInput.value = response;
                    }
                },
                load: fileInput.dataset.pic+"?"
            }
        }
    );
</script>
