@php
    /// Get Modul where has menu
        use App\Models\Modul;
        use App\Models\User;
        $userGroupId = User::with(['userGroup'])->whereId(auth()->id())->first()->userGroup->id;
        $moduls = Modul::with(['menus','accessModul'])
            ->orderBy("order","desc");
        if(auth()->user()->username != "superadmin"){
            $moduls = $moduls->whereRelation("accessModul","app_group_user_id","=",$userGroupId);
        }
        $moduls = $moduls->whereStatus("active")
            /// Check apakah access modul mempunyai access menu
            ->whereHas('menus')
            ->get()
@endphp

<style>
    #header-template {
        margin-left: 300px;
    }

    .navbar {
        height: auto !important;
    }

    .modul-item {
        font-size: 14pt;
    }

    .modul-item a {
        color: #7c8db5;
    }

    .modul-item.active > a {
        border-bottom: 2px solid #435ebe;
        color: #435ebe;
        font-weight: bold;
    }

    @media screen and (max-width: 1200px) {
        #header-template {
            margin-left: 0;
        }
    }
</style>
<div class="card">
    <div class="card-content card-body">
        <div class="d-flex flex-row">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <div class="d-flex flex-wrap flex-row-reverse align-items-center w-100">
                <span class="modul-item mx-2 my-2">
                    <a href="#" class="btn-logout text-red"
                       onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
                </span>
                <form action=" {{ route("logout") }}" id="form-logout" method="post" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @foreach($moduls as $key => $value)
                    <span class="modul-item {{ request()->is($value->pattern) ? "active" : "" }} mx-2 my-2">
                        <a href="{{ url($value->menus->first()->route) }}">{{ $value->name }}</a>
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
