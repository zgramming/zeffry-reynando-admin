<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }

    .card-image-preview {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 150px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
    }

    .card-image-preview .btn-remove-image {
        position: absolute;
        top: 0px;
        right: 0px;
    }
</style>
<div class="modal-header-custom p-4" style="border-bottom: 1px solid #dee2e6;">
    <div class="d-flex flex-row justify-content-between align-items-end">
        <h4 class="modal-title" id="modal-default-label">{{ ($row == null) ? "Form Tambah" : "Form Update" }}</h4>
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close"><i
                class="fa fa-times"></i></button>
    </div>
</div>

<div class="modal-body">
    <form action="{{ url("zeffry-reynando/portfolio/save",[$row?->id ?? 0]) }}" method="POST"
          enctype="multipart/form-data" id="form_validation">
        <div class="row mb-3">
            <label for="banner_image" class="col-sm-12 col-md-12 col-form-label">Banner</label>
            <div class="col-sm-12 col-md-12 d-flex flex-column">
                <input
                    class="form-control img-upload-preview mb-3"
                    id="banner_image"
                    name="banner_image"
                    type="file"
                    accept="image/png, image/jpg, image/jpeg"
                />
                <img
                    src="{{ empty($row?->banner_image) ? null : asset(sprintf("%s/%s/%s","storage",\App\Constant\Constant::PATH_IMAGE_BANNER_PORTFOLIO,$row?->banner_image)) }}"
                    alt="Image Error" class="img-fluid img-thumbnail img-preview-item">
            </div>
        </div>

        <div class="row mb-3">
            <label for="input_job" class="col-sm-12 col-md-12 col-form-label">Tipe</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="type_application_id" id="type_application_id">
                            <option value="">Pilih Tipe</option>
                            @foreach($types as $key => $value)
                                <option
                                    value="{{$value->id}}" {{ $value->id === $row?->type_application_id ? "selected" : "" }}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="input_job" class="col-sm-12 col-md-12 col-form-label">Teknologi Utama</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="main_technology_id" id="main_technology_id">
                            <option value="">Pilih Teknologi</option>
                            @foreach($technologies as $key => $value)
                                <option
                                    value="{{$value->id}}" {{ $value->id === $row?->main_technology_id ? "selected" : "" }}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-sm-12 col-md-12 col-form-label">Title</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="title" class="form-control" id="title" value="{{$row?->title}}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="title_slug" class="col-sm-12 col-md-12 col-form-label">Slug</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="title_slug" class="form-control" id="title_slug" value="{{$row?->title_slug}}"
                       required readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="short_description" class="col-sm-12 col-md-12 col-form-label">Deskripsi Singkat</label>
            <div class="col-sm-12 col-md-12">
                <textarea name="short_description" id="short_description"
                          class="form-control">{{ $row?->short_description }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="full_description" class="col-sm-12 col-md-12 col-form-label">Deskripsi Lengkap</label>
            <div class="col-sm-12 col-md-12">
                <textarea name="full_description" id="full_description"
                          class="form-control">{!! $row?->full_description !!}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            @if(empty($row))
                <label for="preview_image" class="col-sm-12 col-md-12 col-form-label">Preview Image</label>
                <div class="col-sm-12 col-md-12">
                    <input
                        class="form-control mb-3"
                        id="preview_image"
                        name="preview_image[]"
                        type="file"
                        accept="image/png, image/jpg, image/jpeg"
                        multiple
                    />
                </div>
            @else
                <div class="col-md-12">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row justify-content-between">
                            <label for="preview_image" class="col-form-label">Preview Image</label>
                            <label for="preview_image" class="btn btn-success btn-add-image">Tambah Gambar</label>
                            <input
                                class="d-none"
                                id="preview_image"
                                name="preview_image"
                                type="file"
                                accept="image/png, image/jpg, image/jpeg"
                            />
                        </div>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row container-image-preview">
                                    {{--                                    <div class="col-md-3">--}}
                                    {{--                                        <div class="card-image-preview">--}}
                                    {{--                                            <img src="https://picsum.photos/200" class="rounded" alt=""/>--}}
                                    {{--                                            <button type="button" class="btn btn-danger btn-remove-image">Hapus</button>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row mb-3">
            <label for="web_url" class="col-sm-12 col-md-12 col-form-label">Link Web</label>
            <div class="col-sm-12 col-md-12">
                <input type="url" name="web_url" class="form-control" id="web_url" value="{{$row?->web_url}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="github_url" class="col-sm-12 col-md-12 col-form-label">Link Github</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="github_url" class="form-control" id="github_url" value="{{$row?->github_url}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="google_playstore_url" class="col-sm-12 col-md-12 col-form-label">Link Google Playstore</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="google_playstore_url" class="form-control" id="google_playstore_url"
                       value="{{$row?->google_playstore_url}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="app_store_url" class="col-sm-12 col-md-12 col-form-label">Link Appstore</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="app_store_url" class="form-control" id="app_store_url"
                       value="{{$row?->app_store_url}}">
            </div>
        </div>

        @csrf
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-sm-block d-none">Close</span>
    </button>
    <button type="submit" class="btn btn-primary" name="btn-submit" form="form_validation">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-sm-block d-none">Submit</span>
    </button>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        const isUpdated = `{{ !empty($row) }}`;
        const imagesPreview = @json($imagesPreview);
        const containerImagePreview = $(".container-image-preview");

        const componentImagePreview = (id = "", imageUrl = "") => {
            return `<div class="col-md-3 mb-3">
                        <div class="card-image-preview">
                            <img src="${imageUrl}" class="rounded h-100" alt=""/>
                            <button type="button" class="btn btn-danger btn-remove-image" data-id="${id}">Hapus</button>
                        </div>
                    </div>`;
        };

        if (isUpdated) {
            for (const image of imagesPreview) {
                const html = componentImagePreview(image.id, `{{ asset("storage/".\App\Constant\Constant::PATH_IMAGE_PREVIEW_PORTFOLIO) }}/${image.image}`);
                containerImagePreview.append(html);
            }
        }

        ClassicEditor.create(document.querySelector("#full_description")).catch((error) => {
            console.error(error)
        })

        $("#form_validation").validate({
            rules: {},
            messages: {}
        });

        /// Image Preview on change
        $('.img-preview-item').on("error", function (e) {
            $(this).attr('src', "{{ asset('assets/images/bg/bg.jpg') }}");
        })

        $(".img-upload-preview").on('change', function (e) {
            e.preventDefault();
            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function (x) {
                    $(".img-preview-item").attr('src', x.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#form_validation').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            if (!form.valid()) return false;

            let data = new FormData(form[0]);

            let url = `{{ url("zeffry-reynando/portfolio/save",[$row?->id ?? 0]) }}`;
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    let modal = $("#modal-default");
                    modal.modal('hide');
                    location.reload();
                }
            }).fail(function (xhr, textStatus) {
                console.log("XHR Fail Console", xhr);
                let errors = xhr.responseJSON?.errors ?? xhr.responseJSON?.message ?? "Terjadi masalah, coba beberapa saat lagi";
                showErrorsOnModal(errors);
            }).done(function (xhr, textStatus) {
                console.log("done : ", xhr);
            });
        })

        $('#title').on('keyup', debounce(function () {
            const slug = textToSlug(this.value);
            $("#title_slug").val(slug)
        }, 500));

        /// Add Image
        $('#preview_image').on("change", async function (e) {
            const data = new FormData();
            const file = $(this).prop('files')[0];
            if (!file) return;
            data.append('file', file);

            const result = await $.ajax({
                url: `{{ url("api/portfolio/upload_image_preview/$row?->id") }}`,
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
            }).then();

            const html = componentImagePreview(result.data.id, `{{ asset(sprintf("%s/%s","storage",\App\Constant\Constant::PATH_IMAGE_PREVIEW_PORTFOLIO)) }}/${result.data.image}`);
            containerImagePreview.append(html);
            alert("berhasil upload gambar")
        });

        /// Remove Image
        $('.container-image-preview').on('click', '.btn-remove-image', async function (e) {
            const id = $(this).data("id");
            // alert(id);
            // return false;
            const result = await $.ajax({
                url: `{{ url("api/portfolio/remove_image_preview") }}/${id}`,
                method: "POST",
            }).then();

            if (result.success) {
                alert("Berhasil menghapus gambar");
                const parent = $(this).closest(".col-md-3");
                parent.remove();
            }
        });
    });

    async function addImage() {

    }

    async function removeImage() {
    }

    function textToSlug(value = "") {
        if (value.length === 0 || value === "") return "";
        return value.toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
</script>
