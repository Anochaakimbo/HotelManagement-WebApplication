<x-action-section>
    <x-slot name="title">
        {{ __('ลบบัญชี') }}
    </x-slot>

    <x-slot name="description">
        {{ __('ลบบัญชีของคุณแบบถาวร') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('เมื่อบัญชีของคุณถูกลบแล้ว ทรัพยากรและข้อมูลทั้งหมดจะถูกลบอย่างถาวร ก่อนที่จะลบบัญชีของคุณ กรุณาดาวน์โหลดข้อมูลหรือรายละเอียดใด ๆ ที่คุณต้องการเก็บรักษาไว้') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('ลบบัญชี') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('ลบบัญชี') }}
            </x-slot>

            <x-slot name="content">
                {{ __('คุณแน่ใจหรือไม่ว่าต้องการลบบัญชีของคุณ? เมื่อบัญชีของคุณถูกลบแล้ว ทรัพยากรและข้อมูลทั้งหมดจะถูกลบอย่างถาวร กรุณากรอกรหัสผ่านของคุณเพื่อยืนยันว่าคุณต้องการลบบัญชีของคุณอย่างถาวร') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('รหัสผ่าน') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('ยกเลิก') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('ลบบัญชี') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
