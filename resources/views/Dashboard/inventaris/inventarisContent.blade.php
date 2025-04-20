<div id="tablesContent" class="container-fluid clsNav">
    <div class="card mb-4">
        <div class="d-flex mt-3 p-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventarisModal">
                + Tambah Inventaris
            </button>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kondisi
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Jumlah</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listInventaris as $item)
                            <tr
                                @if (!$item->is_active) style="background-color: rgba(128, 128, 128, 0.2);" @endif>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->Name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->condition->name }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{ $item->quantity }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                        data-bs-toggle="modal" data-bs-target="#editInventarisModal"
                                        data-id="{{ $item->id }}" data-name="{{ $item->Name }}"
                                        data-condition="{{ $item->condition_id }}" data-quantity="{{ $item->quantity }}"
                                        data-active="{{ $item->is_active }}" data-created-by="{{ $item->created_by }}"
                                        title="Edit Inventaris">
                                        Edit
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
                        <input type="text" name="Name" class="form-control" id="nameInventaris"
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
                        <input type="text" name="Name" class="form-control" id="editNameInventaris"
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
</script>
