<div class="flex gap-2 m-4">
    <button type="button" id="bulkDeleteBtn"
        class="px-4 py-2 bg-red-500 text-white text-xs rounded-md hidden"
        data-modal-target="default-modal-delete"
        data-modal-toggle="default-modal-delete">
        Hapus yang Dipilih
    </button>

    <button type="button" id="clearSelectionBtn"
        class="px-4 py-2 bg-gray-500 text-white text-xs rounded-md hidden">
        Clear Pilihan
    </button>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAll = document.getElementById('checkAll');
    const checkItems = document.querySelectorAll('.checkItem');
    const deleteBtn = document.getElementById('bulkDeleteBtn');
    const clearBtn = document.getElementById('clearSelectionBtn');
    const bulkForm = document.getElementById('bulkDeleteForm');

    let selectedIds = [];

    // Load from localStorage (unique per page using pathname)
    const storageKey = 'selectedIds_' + window.location.pathname;

    selectedIds = JSON.parse(localStorage.getItem(storageKey) || '[]');

    // Restore checked state
    checkItems.forEach(item => {
        if (selectedIds.includes(item.value)) {
            item.checked = true;
        }
    });

    function toggleButtons() {
        const anyChecked = selectedIds.length > 0;
        deleteBtn.classList.toggle('hidden', !anyChecked);
        clearBtn.classList.toggle('hidden', !anyChecked);
    }
    toggleButtons();

    checkItems.forEach(item => {
        item.addEventListener('change', () => {
            if (item.checked) {
                if (!selectedIds.includes(item.value)) selectedIds.push(item.value);
            } else {
                selectedIds = selectedIds.filter(id => id !== item.value);
            }
            localStorage.setItem(storageKey, JSON.stringify(selectedIds));
            toggleButtons();
        });
    });

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            checkItems.forEach(item => {
                item.checked = checkAll.checked;

                if (checkAll.checked && !selectedIds.includes(item.value)) {
                    selectedIds.push(item.value);
                } else if (!checkAll.checked) {
                    selectedIds = selectedIds.filter(id => id !== item.value);
                }
            });

            localStorage.setItem(storageKey, JSON.stringify(selectedIds));
            toggleButtons();
        });
    }

    if (bulkForm) {
        bulkForm.addEventListener('submit', function () {
            selectedIds.forEach(id => {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'ids[]';
                hidden.value = id;
                bulkForm.appendChild(hidden);
            });

            localStorage.removeItem(storageKey);
        });
    }

    clearBtn.addEventListener('click', function () {
        selectedIds = [];
        checkItems.forEach(item => item.checked = false);
        if (checkAll) checkAll.checked = false;

        localStorage.removeItem(storageKey);
        toggleButtons();
    });

});
</script>
@endpush
