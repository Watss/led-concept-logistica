<x-app-layout>

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Dashboard </h1>
        {{-- <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
            Get more card examples
        </a> --}}
    </div>
    <div class="row">
        <div class="col-3 col-md-3">
            <div class="card d-flex bg-primary text-white justify-content-center align-items-center p-3">
                <div class="h2 text-white fw-bold">{{$budgets}}</div>
                <div class="fw-bold">COTIZACIONES</div>
            </div>
            <div class="card d-flex flex-row justify-content-between p-5 h-50 d-inline-block">
                <div class="d-flex flex-column">
                    <div class="fw-bold h2">{{$new_budgets}}</div>
                    <div class="">Nuevas cotizaciones</div>
                </div>
                <div style="font-size: 26px;">
                    <i class="fas fa-briefcase text-muted"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card d-flex bg-primary text-white justify-content-center align-items-center p-3 ">
                <div class="h3 text-white fw-bold">{{$products}}</div>
                <div class="fw-bold">PRODUCTOS</div>
            </div>
            <div class="card d-flex flex-row justify-content-between p-5 h-50 d-inline-block">
                <div class="d-flex flex-column">
                    <div class="fw-bold h2">{{$new_products}}</div>
                    <div class="">Nuevos Productos </div>
                </div>
                <div style="font-size: 26px;">
                    <i class="fas fa-boxes text-muted"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card d-flex bg-primary text-white justify-content-center align-items-center p-3">
                <div class="h3 text-white fw-bold">{{$users}}</div>
                <div class="fw-bold">USUARIOS</div>
            </div>
            <div class="card d-flex flex-row justify-content-between p-5 h-50 d-inline-block ">
                <div class="d-flex flex-column">
                    <div class="fw-bold h2 ">{{$new_users}}</div>
                    <div class="">Nuevos usuarios</div>
                </div>
                <div style="font-size: 26px;">
                    <i class=" text-muted fab fa-phabricator"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card d-flex bg-primary text-white justify-content-center align-items-center p-3">
                <div class="h3 text-white fw-bold">{{$clients}}</div>
                <div class="fw-bold">CLIENTES</div>
            </div>
            <div class="card d-flex flex-row justify-content-between p-5 h-50 d-inline-block">
                <div class="d-flex flex-column">
                    <div class="fw-bold h2">{{$new_clients}}</div>
                    <div class="">Nuevos clientes</div>
                </div>
                <div style="font-size: 26px;">
                    <i class="text-muted fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
