<x-app-layout>
    <x-slot name="header">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analisis Visi Misi') }}
            </h2>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah
            </button>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <table class="min-w-full bg-white border border-gray-500">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 border">No</th>
                            <th class="px-4 py-2 border">Visi</th>
                            <th class="px-4 py-2 border">Misi</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visi_misi as $visimisi)
                            <tr>
                                <td class="px-1 py-2 border">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border">{{ $visimisi->visi }}</td>
                                <td class="px-4 py-2 border">{{ $visimisi->misi }}</td>
                                <td class="px-4 py-2 border">{{ $visimisi->deskripsi }}</td>
                                <td class="px-1 py-3 border flex flex-col items-center space-y-2">
                                    <!-- Tombol Edit -->
                                    <button 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $visimisi->id }}">
                                        Edit
                                    </button>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('pages.visi_misi.destroy', $visimisi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="exampleModal{{ $visimisi->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pages.visi_misi.update', $visimisi->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" hidden name="id" value="{{ $visimisi->id }}">
            
                                                <div class="mb-3">
                                                    <label for="visi" class="form-label">Visi:</label>
                                                    <input type="text" class="form-control" id="visi" name="visi" value="{{ $visimisi->visi }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="misi" class="form-label">Misi:</label>
                                                    <textarea class="form-control" id="misi" name="misi" required>{{  $visimisi->misi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="deskripsi" class="form-label">Deskripsi:</label>
                                                  <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{  $visimisi->deskripsi }}</textarea>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        @endforeach
                    </tbody>
                </table>

                {{-- Modal --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pages.visi_misi.add') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="visi" class="form-label">Visi:</label>
                                        <input type="text" class="form-control" id="visi" name="visi" value="{{ session('visi') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="misi" class="form-label">Misi:</label>
                                        <textarea class="form-control" id="misi" name="misi" value="{{ session('misi') }}" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                      <label for="deskripsi" class="form-label">Deskripsi:</label>
                                      <textarea class="form-control" id="deskripsi" name="deskripsi" value="{{ session('deskripsi') }}" required></textarea>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>   
                  {{-- End Modal --}}

                @if($visi_misi->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.getElementById('exampleModal').addEventListener('show.bs.modal', function (event) {
         const button = event.relatedTarget; // Button yang memicu modal
         const recipient = button.getAttribute('data-whatever'); // Ambil data dari button
         const modalTitle = this.querySelector('.modal-title');
         const modalBodyInput = this.querySelector('.modal-body input');
     
         modalTitle.textContent = 'Tambah Visi Misi ';
         // modalBodyInput.value = recipient;
    });
</x-app-layout>