 <!-- start sidebar -->
 <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">


    <!-- sidebar content -->
    <div class="flex flex-col">

      <!-- sidebar toggle -->
      <div class="text-right hidden md:block mb-4">
        <button id="sideBarHideBtn">
          <i class="fad fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->

      <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Mantención</p>

      <!-- link -->
      <a href="/" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-chart-pie text-xs mr-2"></i>
        Dashboard
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="{{route('client.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500 {{Request::is('client*') ? 'text-yellow-400' : '' }}">
        <i class="fad fa-users text-xs mr-2"></i>
        Clientes
      </a>

      <a href="{{route('product.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500 {{Request::is('product*') ? 'text-yellow-400' : '' }}">
        <i class="fad fa-user-lock text-xs mr-2"></i>
        Usuarios
      </a>

      <a href="{{route('product.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500 {{Request::is('client*') ? 'text-yellow-400' : '' }}">
        <i class="fad fa-boxes text-xs mr-2"></i>
        Productos
      </a>


      <!-- end link -->

      <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Configuración</p>

      <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-clipboard-list text-xs mr-2"></i>
        Marcas
      </a>
      <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
        <i class="fad fa-folder-open text-xs mr-2"></i>
        Estados de Cotización
      </a>
      <!-- end link -->

       <!-- end link -->

       <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Cotizaciones</p>

       <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
         <i class="fad fa-file-pdf text-xs mr-2"></i>
         Nueva Cotización
       </a>
       <a href="./index-1.html" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
         <i class="fad fa-file text-xs mr-2"></i>
         Administrar Cotizaciones
       </a>
       <!-- end link -->




    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->
