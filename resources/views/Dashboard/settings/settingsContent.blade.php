<div class="container mt-5">
    <h2>Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="target-device" class="form-label">Target Device</label>
            <input type="text" class="form-control" id="target-device" name="target-device" value="{{ $targetDevice->value }}" required>
        </div>

        <div class="mb-3">
            <label for="financial-target" class="form-label">Financial Target</label>
            <input type="text" class="form-control" id="financial-target" name="financial-target" value="{{ $financialTarget->value }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
