<div class="grid items-center justify-center mx-auto">
    <label class="block mx-auto text-center font-oswald text-xl font-semibold">
        {{ __('Additional Down Payment') }}
        <div class="col-md-6">
            <input type="radio" wire:model.lazy="downpayment" id="250" value="250" >    <label class="sm:text-xs md:text-base 2xl:text-xl" >250</label>
            <input type="radio" wire:model.lazy="downpayment" id="500" value="500" >    <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$500</label>
            <input type="radio" wire:model.lazy="downpayment" id="750" value="750" >    <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$750</label>
            <input type="radio" wire:model.lazy="downpayment" id="1000" value="1000" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,000</label>
            <input type="radio" wire:model.lazy="downpayment" id="1250" value="1250" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,250</label>
            <input type="radio" wire:model.lazy="downpayment" id="1500" value="1500" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,500</label>
            <input type="radio" wire:model.lazy="downpayment" id="1750" value="1750" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,750</label>
            <input type="radio" wire:model.lazy="downpayment" id="2000" value="2000" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$2,000</label>
            <hr class="border-2 border-gray-300">
        </div>
    </label>
</div>
