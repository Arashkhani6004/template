<div class="number d-flex align-items-center justify-content-center">
    <div class="value-button d-flex align-items-center justify-content-center dynamic-color" id="decrease" @click="decreaseQuantity()" value="Decrease Value">
        <i class="bi bi-dash d-flex"></i>
    </div>
    <input type="text" class="font-num-r" readonly id="number" value="1" />
    <div class="value-button d-flex align-items-center justify-content-center dynamic-color" id="increase" @click="increaseQuantity()" value="Increase Value">
        <i class="bi bi-plus d-flex"></i>
    </div>
</div>
