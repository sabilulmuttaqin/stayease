<div id="BottomNav" class="relative flex w-full h-[138px] shrink-0">
    <div class="fixed bottom-5 w-full max-w-[640px] px-5 z-10">
        <div class="flex items-center justify-between rounded-[40px] py-4 px-6 bg-ngekos-black">
            <p class="font-bold text-xl leading-[30px] text-white">
                Rp {{ number_format($boardingHouse->price, 0, ',', '.') }}
                <br />
                <span class="text-sm font-normal">/bulan</span>
            </p>
            <a href="{{ route('boarding-house.room', $boardingHouse->slug) }}"
                class="flex shrink-0 rounded-full py-[14px] px-5 bg-ngekos-orange font-bold text-white">Book Now</a>
        </div>
    </div>
</div>
