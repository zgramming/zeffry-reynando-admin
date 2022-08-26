<style>
    .ck-editor__editable_inline {
        min-height: 400px;
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
    <form action="{{ url("zeffry-reynando/work-experience/save",[$row?->id ?? 0]) }}" method="POST"
          enctype="multipart/form-data" id="form_validation">

        <div class="row mb-3">
            <label for="input_job" class="col-sm-12 col-md-12 col-form-label">Pekerjaan</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="job_id" id="job_id">
                            <option value="">Pilih Pekerjaan</option>
                            @foreach($jobs as $key => $value)
                                <option
                                    value="{{$value->id}}" {{ $value->id === $row?->job_id ? "selected" : "" }}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="input_job" class="col-sm-12 col-md-12 col-form-label">Kantor / Perusahaan</label>
            <div class="col-sm-12 col-md-12">
                <div class="d-flex flex-column">
                    <div class="combobox-container">
                        <select class="form-select select2-custom" name="company_id" id="company_id">
                            <option value="">Pilih Kantor / Perusahaan</option>
                            @foreach($companies as $key => $value)
                                <option
                                    value="{{$value->id}}" {{ $value->id === $row?->company_id ? "selected" : "" }}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_date" class="col-sm-12 col-md-12 col-form-label">Mulai</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Mulai Kerja"
                       onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}"
                       value="{{$row?->start_date}}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="end_date" class="col-sm-12 col-md-12 col-form-label">Selesai</label>
            <div class="col-sm-12 col-md-12">
                <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Selesai Kerja"
                       onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}"
                       value="{{$row?->end_date}}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="company_image" class="col-sm-12 col-md-12 col-form-label">Gambar</label>
            <div class="col-sm-12 col-md-12 d-flex flex-column">
                <input
                    class="form-control img-upload-preview mb-5"
                    id="company_image"
                    name="company_image"
                    type="file"
                    accept="image/png, image/jpg, image/jpeg"
                />
                <img
                    src="{{ empty($row?->company_image) ? null : asset(sprintf("%s/%s/%s","storage",\App\Constant\Constant::PATH_IMAGE_COMPANY,$row?->company_image)) }}"
                    alt="Image Error" class="img-fluid img-thumbnail img-preview-item">
            </div>
        </div>

        <div class="row mb-3">
            <label for="description" class="col-sm-12 col-md-12 col-form-label">Deskripsi Pekerjaan</label>
            <div class="col-sm-12 col-md-12">
                <textarea name="description" id="description" class="form-control">{!! $row?->description !!}</textarea>
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

        ClassicEditor.create(document.querySelector("#description")).catch((error) => {
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

            let url = `{{ url("zeffry-reynando/work-experience/save",[$row?->id ?? 0]) }}`;
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
    });
</script>
