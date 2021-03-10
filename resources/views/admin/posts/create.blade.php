<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="md:max-w-7xl mx-auto sm:px-6 lg:px-8 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl
        transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true"
             aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <p style="margin-bottom: 10px">Новый пост</p>
                        <div class="mb-4">
                            <select wire:model="category_id" class="form-select" aria-label="Default select example">
                                <option selected>Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                                @if($category_id)
                                    {{ $category_id }}
                                @endif
                                @error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">
                                Название:
                            </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2"
                                   placeholder="Введите название" wire:model="title">
                            @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4"  >
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">
                                Текст:
                            </label>
                            <textarea rows="14" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline" id="editor" name="body"
                                      data-note="@this" wire:model="body" placeholder="Введите текст"></textarea>
                            @error('body') <span class="text-red-500">{{ $message }}</span>@enderror

                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                          <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full
                          rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium
                          text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700
                          focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Сохранить
                          </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                          <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full
                          rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium
                          text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300
                          focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Выход
                          </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
