<div>
    <form class="d-flex" role="search" wire:submit.prevent="processFormSearch">
        <div class="input-group">
            <input wire:model="searchQuery" type="text" class="form-control rounded-0" id="search-cart" placeholder="Cari..."
                style="box-shadow: none; width: 600px;">
            <div class="input-group-append" style="height : 80%;">
                <button type="submit" class="btn btn-light input-group-text rounded-0 border-0 text-white bg-main-color"
                    style="width: 60x">
                    <i class="bi bi-search" style="font-size: 25px;"></i>
                </button>
            </div>
        </div>
    </form>
</div>
