<div>
    <!-- Show success message -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    <!-- Filters Row -->
    <div class="row">
        <form wire:submit.prevent="someMethodToExecute">
            <!-- Add Vendor Button -->
            <div class="col-sm">
                <a class="popup-form btn btn-primary" href="#addVendor" style="width: 200px;">Add Vendor</a>
            </div>

            <!-- Engine / Make Dropdown -->
            <div class="col-sm">
                <h6>Engine / Make</h6>
                <select class="form-control" wire:model="selectedEngine">
                    <option value="0"></option>
                    @forelse($edatas as $edata)
                        <option value="{{ $edata->id }}">{{ $edata->name }}</option>
                    @empty
                        <option value="">No engines available</option>
                    @endforelse
                </select>
            </div>

            <!-- Other Dropdowns -->
            <!-- ... (Similar dropdowns for $pdatas1, $pdatas2, etc., following the pattern above) -->

            <!-- Submit Button -->
            <div class="col-sm">
                <button type="submit" class="btn btn-primary">LookUp</button>
            </div>
        </form>
    </div>

    <!-- Display Vendor Table -->
    <!-- ... (Here would be your code to display the Vendor table data) -->
</div>
