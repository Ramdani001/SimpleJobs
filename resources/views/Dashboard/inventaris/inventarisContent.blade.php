<div id="tablesContent" class="container-fluid clsNav">
    <div class="card mb-4">
        <div class="d-flex justify-content-between mt-3 p-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventarisModal">
                + Tambah Inventaris
            </button>
            <a href="{{ route('inventaris.export') }}" class="btn btn-success me-2">
                Export Excel
            </a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;"
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                No</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                Nama</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                Kondisi
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                Jumlah</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                Tanggal Dibuat</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listInventaris as $index => $item)
                            <tr`>
                                <td style="width: 50px;" class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{ $listInventaris->firstItem() + $index }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->condition->name }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $item->quantity }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $item->created_at->format('d-m-Y H:i') }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#editInventarisModal" data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}" data-condition="{{ $item->condition_id }}"
                                        data-quantity="{{ $item->quantity }}" data-active="{{ $item->is_active }}"
                                        data-created-by="{{ $item->created_by }}" title="Edit Inventaris">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger ms-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteInventarisModal" data-id="{{ $item->id }}"
                                        title="Delete Inventaris">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data inventaris.</td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 px-3">
                    {{ $listInventaris->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addInventarisModal" tabindex="-1" aria-labelledby="addInventarisLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('inventaris.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addInventarisLabel">Tambah Inventaris</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="nameInventaris"
                            placeholder="Nama Inventaris" required>
                        <label for="nameInventaris">Nama Inventaris</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="condition_id" class="form-select" id="conditionInventaris" required>
                            <option selected disabled>Pilih Kondisi</option>
                            @foreach ($conditions as $condition)
                                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                            @endforeach
                        </select>
                        <label for="conditionInventaris">Kondisi</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" class="form-control" id="quantityInventaris"
                            placeholder="Jumlah" required>
                        <label for="quantityInventaris">Jumlah</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editInventarisModal" tabindex="-1" aria-labelledby="editInventarisLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formEditInventaris">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editInventarisLabel">Edit Inventaris</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="editNameInventaris"
                            placeholder="Nama Inventaris" required>
                        <label for="editNameInventaris">Nama Inventaris</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="condition_id" class="form-select" id="editConditionInventaris" required>
                            <option selected disabled>Pilih Kondisi</option>
                            @foreach ($conditions as $condition)
                                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                            @endforeach
                        </select>
                        <label for="editConditionInventaris">Kondisi</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" class="form-control" id="editQuantityInventaris"
                            placeholder="Jumlah" required>
                        <label for="editQuantityInventaris">Jumlah</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteInventarisModal" tabindex="-1" aria-labelledby="deleteInventarisLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="formDeleteInventaris">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteInventarisLabel">Hapus Inventaris</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus inventaris ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const editModal = document.getElementById('editInventarisModal');
    editModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const condition = button.getAttribute('data-condition');
        const quantity = button.getAttribute('data-quantity');

        const form = document.getElementById('formEditInventaris');
        form.action = `/inventaris/${id}`;

        document.getElementById('editNameInventaris').value = name;
        document.getElementById('editConditionInventaris').value = condition;
        document.getElementById('editQuantityInventaris').value = quantity;
    });

    const deleteModal = document.getElementById('deleteInventarisModal');
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');

        const form = document.getElementById('formDeleteInventaris');
        form.action = `/inventaris/${id}`;
    });
</script>
