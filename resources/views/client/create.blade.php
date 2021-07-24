<x-app-layout>
    <div>
          <div>

          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('clients.store')}}" method="POST">
                @csrf
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-3">
                      <label for="name" class="block text-sm font-medium text-gray-700">Nombre o razón social</label>
                      <input type="text" name="name" id="name" autocomplete="false"  value="{{$client->name}}" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-3">
                        <label for="rut" class="block text-sm font-medium text-gray-700">Rut</label>
                        <input type="text" name="rut" id="rut" autocomplete="false" value="{{$client->rut}}" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>
                    <div class="col-span-3">
                      <label for="type" class="block text-sm font-medium text-gray-700">Tipo (Empresa - Persona)</label>
                      <select id="type" name="type" autocomplete="false" value="{{$client->type}}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                        <option value="empresa" {{$client->type === 'empresa' ? 'selected' : ''}}>Empresa</option>
                        <option value="persona" {{$client->type === 'persona' ? 'selected' : ''}}>Persona</option>
                      </select>
                    </div>
                    <div class="col-span-3">
                        <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                        <input type="text" name="address" id="address" autocomplete="false" value="{{$client->address}}" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>
                      <div class="col-span-2">
                          <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                          <input type="text" name="phone" id="phone" autocomplete="false" value="{{$client->phone}}" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" id="email" autocomplete="false" value="{{$client->email}}" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>
                          <div class="col-span-2">
                            <label for="draft" class="block text-sm font-medium text-gray-700">Giro</label>
                            <input type="text" name="draft" id="draft" autocomplete="false" value="{{$client->draft}}" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                          </div>
                  </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Guardar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

</x-app-layout>
