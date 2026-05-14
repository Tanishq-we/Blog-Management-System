/* =============================================
   BlogHub - Admin Blog Form JS (admin-blog-form.js)
   Handles: Quill editor, slug generation,
            char counter, image preview
   ============================================= */

$(document).ready(function () {

    // ==========================================
    // TINYMCE RICH TEXT EDITOR
    // ==========================================
    if ($('#richEditor').length) {
        tinymce.init({
            selector: '#richEditor',
            height: 400,
            plugins: 'table lists link image code',
            toolbar: 'undo redo | blocks | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image code',
            menubar: false,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            paste_data_images: true,
            content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px } img { max-width: 100%; height: auto; }",
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                resolve('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
            }),
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });

        // Basic validation on form submit
        $('#blogForm').on('submit', function (e) {
            const content = tinymce.get('richEditor').getContent({format: 'text'}).trim();
            if (content.length < 10) {
                alert('Please enter blog content (minimum 10 characters).');
                return false;
            }
        });
    }

    // ==========================================
    // AUTO SLUG GENERATION FROM TITLE
    // ==========================================
    $('#titleInput').on('input', function () {
        const title = $(this).val();
        const slug = title
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('#slugPreview').val(slug);
    });

    // ==========================================
    // CHARACTER COUNTER FOR SHORT DESCRIPTION
    // ==========================================
    const $desc = $('#shortDesc');
    const $counter = $('#descCounter');

    function updateCounter() {
        const len = $desc.val().length;
        $counter.text(len + '/500');
        $counter.css('color', len > 450 ? '#ef4444' : len > 400 ? '#f59e0b' : '#64748b');
    }

    $desc.on('input', updateCounter);
    updateCounter(); // initialize on page load (edit mode)

    // ==========================================
    // IMAGE UPLOAD WITH PREVIEW
    // ==========================================
    const $imageInput  = $('#imageInput');
    const $preview     = $('#imagePreview');
    const $placeholder = $('#uploadPlaceholder');
    const $clearBtn    = $('#clearImage');
    const $zone        = $('#imageUploadZone');

    $imageInput.on('change', function () {
        const file = this.files[0];
        if (!file) return;

        // Validate type
        const allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        if (!allowed.includes(file.type)) {
            alert('Invalid file type. Please upload JPEG, PNG, GIF or WebP.');
            this.value = '';
            return;
        }

        // Validate size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Image is too large. Maximum size is 2MB.');
            this.value = '';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function (e) {
            $preview.attr('src', e.target.result).css({
                'display': 'block',
                'width': '100%',
                'border-radius': '8px',
                'max-height': '240px',
                'object-fit': 'cover'
            });
            $placeholder.hide();
            $clearBtn.removeClass('d-none');
        };
        reader.readAsDataURL(file);
    });

    // Drag & drop support
    $zone.on('dragover', function (e) {
        e.preventDefault();
        $(this).css('border-color', '#2979ff');
    });
    $zone.on('dragleave', function () {
        $(this).css('border-color', '');
    });
    $zone.on('drop', function (e) {
        e.preventDefault();
        $(this).css('border-color', '');
        const file = e.originalEvent.dataTransfer.files[0];
        if (file) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            $imageInput[0].files = dataTransfer.files;
            $imageInput.trigger('change');
        }
    });

    // Clear image button
    $clearBtn.on('click', function () {
        $imageInput.val('');
        $preview.attr('src', '').hide();
        $placeholder.show();
        $(this).addClass('d-none');
        $zone.css('border-color', '');
    });

});
