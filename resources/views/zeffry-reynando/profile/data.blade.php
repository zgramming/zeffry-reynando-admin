@extends('templates.template') @section('title_header') Modul @endsection
@section('extends-css') @endsection @section('content')

    <style>
        .img-profile {
            width: 250px;
            height: 250px;
        }

        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
    <form
        action="{{ url('zeffry-reynando/profile/save',[$row?->id ?? 0]) }}"
        method="POST"
        enctype="multipart/form-data"
        id="form_validation"
    >

        @csrf
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profile Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 g-0 mb-5">
                                                <div
                                                    class="d-flex justify-content-center"
                                                >
                                                    <img
                                                        src="{{ empty($row?->image)  ? "https://picsum.photos/200/300" : asset(sprintf("%s/%s/%s","storage",\App\Constant\Constant::PATH_IMAGE_PROFILE,$row->image))}}"
                                                        class="img-fluid img-thumbnail image-upload-preview-item img-profile rounded-circle"
                                                        alt="Image Error"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input
                                                    type="text"
                                                    id="name"
                                                    class="form-control"
                                                    name="name"
                                                    placeholder="Nama Lengkap"
                                                    value="{{ $row?->name }}"
                                                />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Motto</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input
                                                    type="text"
                                                    id="motto"
                                                    class="form-control"
                                                    name="motto"
                                                    placeholder="Motto"
                                                    value="{{ $row?->motto}}"

                                                />
                                            </div>

                                            <div class="col-md-4">
                                                <label>Deskripsi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                            <textarea
                                                class="form-control"
                                                id="description"
                                                name="description"
                                                required
                                                rows="3"

                                            >{{ $row?->description }}
                                            </textarea>

                                            </div>

                                            <div class="col-md-4">
                                                <label>Gambar Profile</label>
                                            </div>
                                            <div
                                                class="col-md-8 form-group d-flex flex-column"
                                            >
                                                <input
                                                    class="form-control image-upload-preview"
                                                    id="image"
                                                    name="image"
                                                    type="file"
                                                    accept=".jpg, .png, .jpeg"
                                                />
                                            </div>

                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success"><span
                                                            class="btn-label"><i class="fa fa-save"></i></span>&nbsp;Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

@endsection
@section('extends-js')
    <script type="text/javascript">
        $(document).ready(function(){
            ClassicEditor.create(document.querySelector("#description")).catch((error) => {
                console.error(error)
            })
        });
    </script>
@endsection
